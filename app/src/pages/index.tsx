import * as React from "react"
import type { HeadFC, PageProps } from "gatsby"
import Layout, { SEO } from "../templates/layout"


const IndexPage: React.FC<PageProps> = () => {
  return (
    <Layout>
      <h1 className="text-xl">Welcome to my playground</h1>
      <p className="max-w-xl">
      By day, I write backend code. By night, I build <b>interactive algorithm</b> demos to trick myself into learning.
      This site is where I tear apart <b>systems</b> until they make sense <small>(or until I give up)</small>. If you also enjoy deeply flawed first drafts, you’ll fit right in.
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