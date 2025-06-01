import * as React from "react"
import Layout, { SEO } from "../templates/layout"


export default function Page() {
  return <Layout>
    <div>
      Building some stuff in Go, TypeScript, Docker, Kubernetes, MongoDB etc.

      <div className="mt-5">
        Some of my projects:
      <ul className="ml-5 list-disc">
        <li>hpdb.ru</li>
        <li>langapi.borisd.ru</li>
        <li>t.me/purchase_list_bot</li>
        <li>My k3s-cluster</li>
        <li>⬇️</li>
      </ul>
      </div>
    </div>
  </Layout>
}

export const Head = () => (
  <SEO title="About me"/>
)