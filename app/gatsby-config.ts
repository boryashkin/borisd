import type { GatsbyConfig } from "gatsby";

const config: GatsbyConfig = {
  siteMetadata: {
    title: `borisd.ru`,
    siteUrl: `https://borisd.ru`
  },
  // More easily incorporate content into your pages through automatic TypeScript type generation and better GraphQL IntelliSense.
  // If you use VSCode you can also use the GraphQL plugin
  // Learn more at: https://gatsby.dev/graphql-typegen
  graphqlTypegen: true,
  plugins: [
    "gatsby-plugin-postcss", "gatsby-plugin-sitemap",
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `blog`,
        path: `${__dirname}/src/pages/blog`,
        ignore: [`**/*.js`],
      },
    },
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `articles`,
        path: `${__dirname}/src/pages/articles`,
        ignore: [`**/*.js`],
      },
    },
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `algorithms`,
        path: `${__dirname}/src/pages/algorithms`,
        ignore: [`**/*.js`],
      },
    },
  ]
};

export default config;
