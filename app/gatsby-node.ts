// gatsby-node.ts
import type { GatsbyNode } from 'gatsby';
import { createContentDigest } from 'gatsby-core-utils'
import path from 'path';
import { readFileSync } from 'fs';
import { parse } from '@babel/parser';
import traverse from '@babel/traverse';
import { PageMetadata, metadataFieldsToNodeValues } from './src/models/index';
import { IndexMetadataDeclaration, IndexMetadataNodeValue, PageContext } from './src/models/index';

interface QueryResult {
  allIndexMetadata: {
    nodes: IndexMetadataNodeValue[];
  }
}

interface PathPrefixesResult {
  allIndexMetadata: {
    nodes: {
      pathPrefixes: string[];
    }[]
  }
}

const postsPerPage = 30;

const sectionTitles : Record<string, string> = {
  'blog': 'Blog posts',
  'articles': 'Articles',
  'articles/dialogs-with-llms': 'Dialogs with LLMs',
  'algorithms': 'Algorithms',
}

export const onCreateNode: GatsbyNode['onCreateNode'] = async ({ node, actions, createNodeId }) => {
  const { createNodeField, createNode } = actions;

  if (node.internal.type === 'File' && node.extension == 'tsx') {
    if (!node.hasOwnProperty('relativePath') || !node.hasOwnProperty('absolutePath')) {
      console.error(`Node ${node.id} does not have a relativePath or absolutePath property.`);
      return;
    }

    try {
      // Read the .tsx file content
      const fileContent = readFileSync(node.absolutePath, 'utf-8');
      
      // Parse the file to extract the metadata export
      const ast = parse(fileContent, {
        sourceType: 'module',
        plugins: ['typescript', 'jsx'],
      });


      let metadataPreFilled: PageMetadata | null = null;
      traverse(ast, {
        ExportNamedDeclaration(path) {
          if (path.node.declaration?.type === 'VariableDeclaration') {
            const declaration = path.node.declaration.declarations.find(
              (decl) => decl.id.type === 'Identifier' && decl.id.name === 'metadata'
            );
            if (declaration && declaration.init?.type === 'ObjectExpression') {
              const properties = declaration.init.properties.reduce((acc, prop) => {
                if (
                  prop.type === 'ObjectProperty' &&
                  prop.key.type === 'Identifier' &&
                  prop.value.type === 'StringLiteral'
                ) {
                  acc[prop.key.name] = prop.value.value;
                }
                return acc;
              }, {} as Record<string, string>);
              metadataPreFilled = properties as PageMetadata;
            }
          }
        },
      });

      if (metadataPreFilled) {
        metadataPreFilled = metadataPreFilled as PageMetadata;
        if (!metadataPreFilled.title || !metadataPreFilled.date) {
          return;
        }

        
        const itemPath = '/' + node.sourceInstanceName + '/' + node.relativePath.replace(/index\.tsx?$/, '').replace(/\.tsx?$/, '');
        const id = createNodeId(`IndexMetadata-${itemPath}`);
        let metadata: IndexMetadataNodeValue = metadataFieldsToNodeValues(id, itemPath, metadataPreFilled);

        console.log("[DEBUG] METADATA metadataFieldsToNodeValues", metadata.pathPrefixes)

        const digest = createContentDigest(metadata);
        createNode({
          ...metadata,
          id: id,
          parent: null,
          children: [],
          internal: {
            type: "IndexMetadata",
            contentDigest: digest,
          },
        })
      } else {
        console.debug(`No metadata found in ${node.absolutePath}`);
      }
    } catch (error) {
      console.error(`Error parsing metadata for ${node.path}:`, error);
    }
  }
};

exports.createSchemaCustomization = ({ actions }) => {
  const { createTypes } = actions
  createTypes(IndexMetadataDeclaration)
}

export const createPages: GatsbyNode['createPages'] = async ({ graphql, actions }) => {
  const { createPage } = actions;

  const pathPrefixesResult = await graphql<PathPrefixesResult>(`
    query {
      allIndexMetadata {
        nodes{
          pathPrefixes
        }
      }
    }
  `);

  if (pathPrefixesResult.errors || !pathPrefixesResult.data) {
    throw pathPrefixesResult.errors;
  }

  if (!pathPrefixesResult.data) throw new Error("Empty GraphQL result")
  
    let uniquePrefixes: Set<string> = new Set();

    for (const prefArray of pathPrefixesResult.data.allIndexMetadata.nodes) {
      for (const prefix of prefArray.pathPrefixes) {
        if (prefix && prefix.length > 0) {
          uniquePrefixes.add(prefix);
        }
      }
    }

  // index pages are created here
  for (const pathSection of uniquePrefixes) {
    const result = await graphql<QueryResult>(`
    query ($section: String!) {
      allIndexMetadata(
        filter:{pathPrefixes:{in: [$section]}}, 
        sort: {date:DESC}
      ){
        nodes{
          path
          pathPrefix
          pathPrefixes
          title
          lang
          description
          date
        }
      }
    }
  `, {"section": pathSection});

    if (result.errors || !result.data) {
      throw result.errors;
    }

    if (!result.data) throw new Error("Empty GraphQL result")

    const posts = result.data.allIndexMetadata.nodes;
    const numPages = Math.ceil(posts.length / postsPerPage);

    Array.from({ length: numPages }).forEach((_, i) => {
      const currentPage = i + 1;
      const skip = i * postsPerPage;
      const limit = postsPerPage;
      const ctx: PageContext = {
        limit,
        skip,
        numPages,
        currentPage,
        pathPrefixRoot: `/${pathSection}`,
        section: pathSection,
        listName: sectionToTitle(pathSection),
      }

      createPage({
        path: i === 0 ? `/${pathSection}` : `/${pathSection}/page/${currentPage}`,
        component: path.resolve(`src/templates/index/index.tsx`),
        context: ctx
      });

      console.debug('created a page', pathSection)
    });
  }
};

const sectionToTitle = (section: string): string => {
  return sectionTitles[section] || (section.charAt(0).toUpperCase() + section.slice(1)).replace("-", " ").replace("/", " / ");
}