import * as React from "react"
import Layout, { SEO } from "../../templates/layout"

export default function Page() {
  return (
    <Layout>
        <p>List of contents:</p>
        <ul className="ml-5 list-disc">
            <li>
                <a href="interactive/hamming-code">Hamming Code interactive</a>
            </li>
        </ul>
    </Layout>
  )
}

export const Head = () => (
  <SEO title="Algorithms"/>
)