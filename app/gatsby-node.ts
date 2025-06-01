// gatsby-node.ts
import type { GatsbyNode } from 'gatsby';
import { createContentDigest } from 'gatsby-core-utils'
import path from 'path';
import { readFileSync } from 'fs';
import { parse } from '@babel/parser';
import traverse from '@babel/traverse';
import { BlogMetadata, metadataFieldsToNodeValues } from './src/models/blog';
import { IndexMetadataDeclaration, IndexMetadataNodeValue } from './src/models/index';
import { list } from 'postcss';

interface QueryResult {
  allIndexMetadata: {
    nodes: IndexMetadataNodeValue[];
  }
}

export const onCreateNode: GatsbyNode['onCreateNode'] = async ({ node, actions, createNodeId }) => {
  const { createNodeField, createNode } = actions;

  if (node.internal.type === 'File' && node.sourceInstanceName == 'blog' && node.extension == 'tsx') {
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


      let metadataPreFilled: BlogMetadata | null = null;
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
              metadataPreFilled = properties as BlogMetadata;
            }
          }
        },
      });

      if (metadataPreFilled) {
        metadataPreFilled = metadataPreFilled as BlogMetadata;
        if (!metadataPreFilled.title || !metadataPreFilled.date) {
          return;
        }

        
        const itemPath = '/' + node.sourceInstanceName + '/' + node.relativePath.replace(/\.tsx?$/, '');
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

export const createPages: GatsbyNode['createPages'] = async ({ graphql, actions }) => {
  const { createPage } = actions;

  const result = await graphql<QueryResult>(`
    query {
      allIndexMetadata(
        filter:{pathPrefix:{eq:"blog"}}, 
        sort: {date:DESC}
      ){
        nodes{
          path
          pathPrefix
          title
          description
          date
        }
      }
    }
  `);

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

    createPage({
      path: i === 0 ? '/blog' : `/blog/page/${currentPage}`,
      component: path.resolve(`src/templates/index/index.tsx`),
      context: {
        limit,
        skip,
        numPages,
        currentPage,
        pathPrefix: '/blog',
        listName: 'Blog posts',
      }
    });
  });
};