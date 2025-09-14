import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'A week of algorithms. Kind of.',
  lang: "en",
  description: "Even though I planned to devote this year to personal growth, especially in career related skills, things didn't go as expected. But this week I justfelt like doing some algorithms practice, so I did...",
  date: "2025-09-15",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          Even though I planned to devote this year to personal growth, especially in career related skills, things didn't go as expected. But this week I just felt like doing some algorithms practice, so I did.

          <br /><br />

          I have a repo devoted to algorithms practice: <Link to="https://github.com/boryashkin/algorithm-problem-solving">github.com/boryashkin/algorithm-problem-solving</Link>

          <br />

          My plan was to practice leetcode, but it turned out to be a chore and I already have plenty of them, so I procrastinated.
          Then I remembered the Clash of Code game <Link to="https://www.codingame.com/clashofcode">codingame.com/clashofcode</Link> which I used to play in the past.
          In this game you can see in real time how other people are doing, which makes things easier, since you aren't the only one failing.
          <br />
          I decided to play a round every day before going to sleep, what I realized is:
          
          <ul className="ml-5 list-disc">
            <li>It's kind of fun</li>
            <li>But if you suck at it, and didn't finish in time, you <b>can't check your solution</b> anymore</li>
            <li>I suck at it</li>
          </ul>

          So the better approach is to practice <b>both</b> clash of code and leetcode. The former lets you practice with a time limit, the latter lets you check your solution and learn from it.

          <br /><br />
          I think of making it a weekly or at least some of the days a week/month routine. This weeks results:
          <h3 className="text-1xl mt-5"><b>Week 1</b> (2 09/25)</h3>
            <ul className="ml-5 list-disc">
                <li><b>Mon</b>: Clash of Code - 1</li>
                <li><b>Tue</b>: Clash of Code - 2</li>
                <li><b>Wed</b>: -</li>
                <li><b>Thu</b>: Clash of Code - 1</li>
                <li><b>Fri</b>: -</li>
                <li><b>Sat</b>: -</li>
                <li><b>Sun</b>: Leetcode - 1</li>
            </ul>
            <i>Failed to solve in time all the Clash of Code rounds</i>
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)