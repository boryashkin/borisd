import * as React from "react"
import Layout from "../../components/layout"

export default function Page() {
  return (
    <Layout>
        <p>List of contents:</p>
        <ul className="ml-5 list-disc">
            <li>
                <a href="javascript-numbers">JS numbers</a>
            </li>
        </ul>
    </Layout>
  )
}