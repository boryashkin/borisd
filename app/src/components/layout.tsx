import React from "react"

const docLinks = [
    {
        text: "About me",
        url: "/about",
    },
    {
        text: "Algorithms",
        url: "/algorithms/",
    },
]

export default function Layout({ children }: any) {
    return (
        <main className="p-10">
            <h1 className="">
                <a href="/">borisd</a>
                <br />
                <span className="text-sm bg-amber-200">— Software Developer</span>
            </h1>
            <div className="my-10">
            {children}
            </div>
            <ul className="flex flex-wrap items-center">
                {docLinks.map(doc => (
                    <li key={doc.url} className="me-4">
                        <a
                            className=""
                            href={`${doc.url}`}
                        >
                            {doc.text}
                        </a>
                    </li>
                ))}
            </ul>
        </main>
    )
}