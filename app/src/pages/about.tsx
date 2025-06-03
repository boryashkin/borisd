import * as React from "react"
import Layout, { SEO } from "../templates/layout"


export default function Page() {
  return <Layout>
    <div>
      Building some stuff in Go, TypeScript, Docker, Kubernetes, MongoDB, Postgres etc.

      <div className="mt-5">
        Some of my projects:
      <ul className="ml-5 list-disc">
        <li>t.me/purchase_list_bot</li>
        <li>My k3s-cluster</li>
        <li><a href="https://github.com/boryashkin">github</a></li>
        <li><a href="https://t.me/borischan">telegram channel</a></li>
        <li><s>hpdb.ru</s></li>
        <li><s>langapi.borisd.ru</s></li>
        <li>⬇️</li>
      </ul>
      </div>
    </div>
  </Layout>
}

export const Head = () => (
  <SEO title="About me" description="Software Engineer Exploring Internals, Algorithms, and Code Craft"/>
)