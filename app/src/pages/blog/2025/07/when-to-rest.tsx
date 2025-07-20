import Layout, { SEO } from "../../../../templates/layout"
import BlogWrapper from "../../../../templates/blog/wrapper"
import { PageMetadata } from "../../../../models/index";

export const metadata: PageMetadata = {
  title: 'The productivity mistake I made for years',
  lang: "en",
  description: "I've always had productivity and growth in mind, but I can't say I've been that productive — aside from rare bursts of inspiration and motivation a few times a year. However, I came to a realization: to be productive in general...",
  date: "2025-07-20",
};

export default function Page({ location }: { location: Location }) {
  return (
    <Layout location={location}>
      <BlogWrapper title={metadata.title} publishedAt={metadata.date} lang={metadata.lang}>
        <p>
          I've always had productivity and growth in mind, but I can't say I've been that productive — aside from rare bursts of inspiration and motivation a few times a year.

          <br /><br />

          However, I came to a realization: to be productive in general, you need to schedule all your tasks for workdays, not weekends.
          I can't even count how many times I've delayed tasks until the weekend, only to find myself on Sunday evening having not touched a single one.

          <br /><br />

          So, the general rules are:
          <ul className="ml-5 list-disc">
            <li>Prioritize your growth over the job <i>— work only during work hours</i></li>
            <li>Schedule your learning on workdays <i>— use weekends only as extra time, if needed</i></li>
          </ul>

          Sometimes you work late, sometimes you go on vacation — but the main thing is to stop planning stuff for the weekends.

          <br /><br />

          <b>Grind during workdays</b>. You probably won’t do much on weekends anyway.
        </p>
      </BlogWrapper>
    </Layout>
  )
}

export const Head = () => (
  <SEO title={metadata.title} description={metadata.description} />
)