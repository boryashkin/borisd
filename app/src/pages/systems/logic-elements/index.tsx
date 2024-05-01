import * as React from "react"
import Layout from "../../../components/layout";
import { And32 } from "../../../components/logic";


export default function Page() {
    const sum1 = And32(1, 2)

    return (
        <Layout>
            <h1>And(1, 2) = {sum1.toString(2).slice(-8)}</h1>
            
        </Layout>
    )
}