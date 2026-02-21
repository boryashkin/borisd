import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index"

export const metadata: PageMetadata = {
  title: "Writing blogs on statically generated sites from a phone? Solved by github!",
  lang: "en",
  description: "I've been thinking of making a platform that lets you write posts in a textarea and trigger CI/CD to regenerate Gatsby, Hugo, Jekyll, and more.",
  date: "2026-02-21",
}

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          I've been thinking of making a platform that lets you write posts in a textarea and trigger CI/CD to regenerate Gatsby, Hugo, Jekyll, and more.
        </p>
        <p>
          Next thing I know — the GitHub agent is available on GitHub website, so I opened it and I am writing this post in its textarea right now!
        </p>
        <p>
          I bet the result will be good enough. But as we speak, I notice that autocomplete does not work here, and I need to write apostrophes and spell words myself 😮
        </p>
        <p>
          So what do I have? Gatsby, GitHub Actions to build it (CI/CD), and now the long-dreamed feature — AI agent. Ok, lets press &quot;send&quot;.
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)
