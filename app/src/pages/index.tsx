import * as React from "react"
import type { HeadFC, PageProps } from "gatsby"
import Layout from "../components/layout"

const paragraphStyles = {
  marginBottom: 48,
}
const codeStyles = {
  color: "#8A6534",
  padding: 4,
  backgroundColor: "#FFF4DB",
  fontSize: "1.25rem",
  borderRadius: 4,
}

const IndexPage: React.FC<PageProps> = () => {
  return (
    <Layout>
      <p style={paragraphStyles}>
        Hi! You can read my blogs at linkedin and <a href="https://t.me/borischan">telegram</a>, and see my project on <a href="https://github.com/boryashkin">github</a>.
      </p>
    </Layout>
  )
}

export default IndexPage

export const Head: HeadFC = () => <title>Home Page</title>
