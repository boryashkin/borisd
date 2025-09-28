import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'A week of algorithms 2. Failure.',
  lang: "en",
  description: "Still I tried on Monday and was defeated by \"1071. Greatest Common Divisor of Strings\", spent a lot of time on a soultion that was prone to all edge cases...",
  date: "2025-09-22",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          Had a busy week at work, couldn't even find a minute on something else. And when I do algos, I need more than that.

          <br/>

          Still I tried on Monday and was defeated by "1071. Greatest Common Divisor of Strings", spent a lot of time on a soultion that was prone to all edge cases.

          <br /><br />
          This weeks results:
          <h3 className="text-1xl mt-5"><b>Week 2</b> (2 09/25)</h3>
            <ul className="ml-5 list-disc">
                <li><b>Mon</b>: Leetcode - 1 <i>(but haven't solved it, moved to the next week)</i></li>
                <li><b>Tue</b>: -</li>
                <li><b>Wed</b>: -</li>
                <li><b>Thu</b>: -</li>
                <li><b>Fri</b>: -</li>
                <li><b>Sat</b>: -</li>
                <li><b>Sun</b>: -</li>
            </ul>
            <br />
            <i><Link to="/blog/2025/09/a-week-of-algorithms-kind-of/">{'<'} previous week</Link></i>
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)