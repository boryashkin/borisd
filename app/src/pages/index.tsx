import * as React from "react"
import type { HeadFC, PageProps } from "gatsby"
import Layout, { SEO } from "../templates/layout"


const IndexPage: React.FC<PageProps> = () => {
  return (
    <Layout>
      <h1 className="text-xl">Welcome to my playground</h1>
      <p className="max-w-xl">
        I want to build <b>interactive algorithm</b> demos here and tear apart <b>systems</b> to learn something new. 
        Maybe you'll find something useful here too.
        <br />
        <br />
        Explore.
      </p>
    </Layout>
  )
}

export default IndexPage

export const Head = () => (
  <SEO title="Weird experiments in algorithms & systems" description="Reverse engineering reality, one algorithm at a time. Interactive explainers, hacky prototypes, and occasional rants about databases."/>
)