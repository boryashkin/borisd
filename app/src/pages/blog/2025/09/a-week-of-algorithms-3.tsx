import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'A week of algorithms 3. Among other activities.',
  lang: "en",
  description: "Had a busy week at work, as usual lately, but a bit better than last week, but I prioritized other goals at the same time. For example, I had been riding an e-bicycle before sleep, until I fell and broke my leg on Friday...",
  date: "2025-09-28",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          Had a busy week at work, as usual lately, but a bit better than last week, but I prioritized other goals at the same time.

          For example, I had been riding an e-bicycle before sleep, until I fell and broke my leg on Friday, which got me thinking about projects since I'm in bed all day now. So I started to learn game dev a little.

          <br/>

          Regarding the algorithms: I stared from scratch and solved <i>"1071. Greatest Common Divisor of Strings"</i> for under 30min (still a lot, but I'm only warming up).
          Then I procrastinated and tried to make up for it on Sunday, solving two easy problems (the one about Flowers took me a while though)

          <br /><br />
          This weeks results:
          <h3 className="text-1xl mt-5"><b>Week 3</b></h3>
            <ul className="ml-5 list-disc">
                <li><b>Mon</b>: Leetcode - 1 (<i><Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/cf8c1b5b28f602020600937816f99c72295ea651">"Greatest Common Divisor of Strings"</Link></i>)</li>
                <li><b>Tue</b>: -</li>
                <li><b>Wed</b>: -</li>
                <li><b>Thu</b>: -</li>
                <li><b>Fri</b>: -</li>
                <li><b>Sat</b>: -</li>
                <li><b>Sun</b>: Leetcode - 2 (<i><Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/c66187f61758a5573a1f0eec9e5cf95be481684c">Kids With the Greatest Number of Candies</Link></i>, <i><Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/62601ea88d30081c41e5592fa27284f16edb33b9">Can Place Flowers</Link></i>)</li>
            </ul>
            <br />
            <i><Link to="/blog/2025/09/a-week-of-algorithms-2/">{'<'} previous week</Link></i>
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)