import React from "react"

interface SEOProps {
  title: string;
  description?: string;
  image?: string;
  lang?: string;
  meta?: Array<{ name: string; content: string }>;
}

export const SEO = ({ 
  title,
  description = "borisd cool website", // Fallback if undefined
  image, 
  lang = "en", 
  meta = [] 
}: SEOProps) => {
  return (
    <>
    <title>{title}</title>
    <meta name="description" content={description} />\
    {image && <meta property="og:image" content={image} />}
    {meta.map((tag, i) => (
      <meta key={i} name={tag.name} content={tag.content} />
    ))}
  </>
  );
};

const docLinks = [
    {
        text: "About me",
        url: "/about",
    },
    {
        text: "Algorithms",
        url: "/algorithms/",
    },
    {
        text: "Blog",
        url: "/blog/",
    },
]

export default function Layout({ children }: {children: any}) {
    return (
      <>
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
      </>
    )
}
