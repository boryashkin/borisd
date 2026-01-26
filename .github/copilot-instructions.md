# Borisd Blog - Copilot Instructions

This document provides instructions for Copilot on how to assist with the development of this personal blog. The blog is built with Gatsby and Tailwind CSS, and its main purpose is to share knowledge, showcase skills, and establish an online presence.

## Repository Structure

The repository is organized as follows:

-   `.github/`: Contains GitHub-related files.
    -   `workflows/`: Houses GitHub Actions workflows, such as the deployment pipeline for the Gatsby site.
    -   `copilot-instructions.md`: This file.
-   `app/`: The main directory for the Gatsby application.
    -   `src/`: Contains the source code for the website.
        -   `pages/`: This is where all the content lives.
            -   `blog/YYYY/MM/title.tsx`: Blog posts are located here, structured by year and month.
            -   `articles/`: Longer, more in-depth articles.
            -   `systems/`: Articles related to system design.
            -   `algorithms/`: Interactive articles about algorithms.
        -   `components/`: Reusable React components.
        -   `templates/`: Templates for generating pages dynamically (e.g., for blog posts).
        -   `styles/`: Global stylesheets.
    -   `gatsby-config.ts`: The main configuration file for the Gatsby site.
    -   `gatsby-node.ts`: Used for dynamically creating pages and modifying the Gatsby build process.
    -   `tailwind.config.js`: Configuration for Tailwind CSS.
-   `build/`: Contains build-related files, like Dockerfiles.

## How to Add New Content

### Adding a New Blog Post

To add a new blog post, create a new `.tsx` file under `app/src/pages/blog/`. The path should follow this structure: `app/src/pages/blog/YYYY/MM/post-slug.tsx`.

For example, a post written in February 2026 with the slug `my-new-post` would be located at `app/src/pages/blog/2026/02/my-new-post.tsx`.

Each blog post should export a React component and a GraphQL query for fetching data if needed.

For each blog post, `metadata.description` must be a short, text-only fragment from the first sentence of the main body text (no HTML, links, or formatting), so it can be safely used for SEO and previews.

### Adding a New Article

For longer content, create a new file under `app/src/pages/articles/`. These can be organized into subdirectories if needed.

## Development Workflow

1.  **Navigate to the app directory**: All development commands should be run from the `app/` directory.
2.  **Install dependencies**: Run `npm install` or `yarn install`.
3.  **Start the development server**: Run `npm start` or `yarn start`. This will start a hot-reloading development environment accessible at `http://localhost:8000`.

## Deployment

The site is automatically deployed to GitHub Pages whenever changes are pushed to the `master` branch. The deployment process is defined in `.github/workflows/gatsby.yml`. It builds the Gatsby site and pushes the `public/` directory to the `gh-pages` branch.
