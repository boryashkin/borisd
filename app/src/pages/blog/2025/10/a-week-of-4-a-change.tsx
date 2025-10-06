import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'A week of ... 4.',
  lang: "en",
  description: "Don't remember what happened last week, except that I started to hit the gym again (still wearing a cast on my leg). Game dev is starting to grow on me, spent the whole weekend on that, learning Phaser by doing. Algo...",
  date: "2025-10-06",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          Don't remember what happened last week, except that I started to hit the gym again (still wearing a cast on my leg). Game dev is starting to grow on me, spent the whole weekend on that, learning Phaser by doing.

          <br />

          Algorithms are more like a chore, but I consciously decided to solve them — and even though I don’t really want to anymore, I’m still trying. Hence, the count is fewer than 7 or even 5 a week, but at least it’s not zero.
          But I don't think it's going to be the main theme of the series anymore, only a part of it.

          <br /><br />
          This weeks results:
          <h3 className="text-1xl mt-5"><b>Week 4</b></h3>
            <ul className="ml-5 list-disc">
                <li><b>Mon</b>: </li>
                <li><b>Tue</b>: -</li>
                <li><b>Wed</b>: 1 (<i>lc / <Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/1d7b2b5975a0236bd22bcf75583f36c3407bd5d3">Reverse Vowels of a String</Link></i>)</li>
                <li><b>Thu</b>: 2 (<i>lc / <Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/f104fca737adb28621f7b76178f20ff729415d9d">Reverse Words in a String</Link></i>, <i>lc / <Link to="https://github.com/boryashkin/algorithm-problem-solving/commit/a3baa8554e5eab8ccc397065153a92dbd105fd3e">Product of Array Except Self</Link></i>)</li>
                <li><b>Fri</b>: -</li>
                <li><b>Sat</b>: -</li>
                <li><b>Sun</b>: -</li>
            </ul>
            <br />
            <i><Link to="/blog/2025/09/a-week-of-algorithms-3/">{'<'} previous week</Link></i>
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)