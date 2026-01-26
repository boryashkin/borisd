import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
  title: 'From a Brief Algo Grind to Side Projects',
  lang: "en",
  description: "A while after \"A week of ... 4.\" I quietly dropped the idea of grinding algorithms.",
  date: "2026-01-27",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          A while after <Link to="/blog/2025/10/a-week-of-4-a-change">"A week of ... 4."</Link> I quietly dropped the idea of grinding algorithms. I just lost interest after a few weeks.
        </p>
        <p>
          Instead of forcing it, I stopped. I went back to normal life for a bit: riding the motorcycle, doing other things, not trying to squeeze one more LeetCode problem into every spare hour.
        </p>
        <p>
          After some time away, I wanted to write code again, but not for interview prep. I tried a couple of side projects that didn’t survive the first iteration or two.
        </p>
        <p>
          Then I found a better idea (ASR/STT field) and decided to pursue it seriously. Now I'm still working on it.
        </p>
        <p>
          The tooling changed a lot too, since the time I worked on my projects a year prior. New VS Code features and Copilot made writing and wiring things together noticeably faster, which lowered the friction to just try ideas.
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)
