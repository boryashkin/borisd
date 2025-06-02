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

interface IndexToTitle {
  section: string
  title: string
}

export const createPages: GatsbyNode['createPages'] = async ({ graphql, actions }) => {
  const { createPage } = actions;

  const sections : IndexToTitle[] = [
    {section: 'blog', title: 'Blog posts'},
    {section: 'articles', title: 'Articles'},
    {section: 'algorithms', title: 'Algorithms'},
  ]

  // index pages are created here
  for (const item of sections) {
    const result = await graphql<QueryResult>(`
    query ($section: String!) {
      allIndexMetadata(
        filter:{pathPrefix:{eq:$section}}, 
        sort: {date:DESC}
      ){
        nodes{
          path
          pathPrefix
          title
          lang
          description
          date
        }
      }
    }
  `, {"section": item.section});

    if (result.errors || !result.data) {
      throw result.errors;
    }

    const posts = result.data.allIndexMetadata.nodes;
    const postsPerPage = 30;
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
        pathPrefixRoot: `/${item.section}`,
        section: item.section,
        listName: item.title,
      }

      createPage({
        path: i === 0 ? `/${item.section}` : `/${item.section}/page/${currentPage}`,
        component: path.resolve(`src/templates/index/index.tsx`),
        context: ctx
      });
    });
  }
};