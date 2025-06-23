import * as React from "react"
import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper  from "../../../../templates/blog/wrapper" 
import { PageMetadata } from "../../../../models/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'First post on the website, moving from Telegram',
  lang: "en",
  description: "Hi! I've decided to move my blog here from Telegram, because of a few reasons: I want to learn some new technical things and share them here in an interactive way, I want to practice English...",
  date: "2025-06-02",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
        <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
            <p>Hi! I've decided to move my blog here from <Link to="https://t.me/borischan">Telegram @borischan</Link>, because of a few reasons:</p>
            <ul className="ml-5 list-disc">
                <li>I want to learn some new technical things and <b>share</b> them here in an <b>interactive</b> way.</li>
                <li>i want to practice <i>English</i></li>
                <li>telegram channels are difficult to grow, unsuitable for technical and long posts, <i><small>and i'm sick of it</small></i></li>
            </ul>
            <p>My plan is to grow <Link to="/articles">articles</Link> and <Link to="/algorithms">algorithms</Link>. I already have a page in each, so you can get a gist of what to expect.</p>
        </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description}/>
)