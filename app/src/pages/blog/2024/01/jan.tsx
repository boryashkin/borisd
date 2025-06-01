import * as React from "react"
import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper  from "../../../../templates/blog/wrapper" 
import { BlogMetadata } from "../../../../models/blog";

export const metadata: BlogMetadata = {
  title: 'JAN POST',
  description: "demo post description",
  date: "2024-01-01",
};

export default function Page() {
  return (
    <Layout>
        <BlogWrapper title={metadata.title} publishedAt={metadata.date}>
            <p>Yeah!</p>
        </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description}/>
)