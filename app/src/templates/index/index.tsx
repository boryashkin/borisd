import * as React from 'react';
import { PageProps, graphql, Link } from 'gatsby';
import Layout from '../layout';
import { IndexMetadataNodeValue, PageContext } from '../../models/index';

/*
  * It's still hardcoded as a blog index. 
  * todo: make it more generic.
  */

export const query = graphql`
query ($limit: Int!, $skip: Int!, $section: String!) {
  allIndexMetadata(
    filter:{pathPrefix:{eq:$section}}, 
    sort: {date:DESC} 
    limit: $limit
    skip: $skip
  ){
    nodes{
      id
      path
      pathPrefix
      title
      lang
      description
      date
    }
  }
  site {
    siteMetadata {
      siteUrl
    }
  }
}
`;

interface IndexData {
  allIndexMetadata: {
        nodes: IndexMetadataNodeValue[];
    }
    site: {
        siteMetadata: {
            siteUrl: string;
        };
    };
}

const BlogIndex: React.FC<PageProps<IndexData, PageContext>> = ({ data, pageContext }) => {
  const { nodes } = data.allIndexMetadata;
  const { siteUrl } = data.site.siteMetadata;
  const { currentPage, numPages } = pageContext;

  const isFirst = currentPage === 1;
  const isLast = currentPage === numPages;
  const prevPage = getPrevPageUrl(pageContext);
  const nextPage = getNextPageUrl(pageContext);

  return (
    <Layout>
      <h1>{pageContext.listName ?? 'Contents'}:</h1>
      <ul className="ml-5 list-disc">
        {nodes.map((post) => {
          return (
            <li key={post.path}>
              <small><i>{new Date(post.date).toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                })}</i></small> <Link to={post.path}>
                {post.title}
              </Link>
              <div>
                {post.description ? post.description : ''}
              </div>
            </li>
          );
        })}
      </ul>
      <nav className='mt-10'>
        <ul style={{ display: 'flex', listStyle: 'none', gap: '1rem' }}>
          {!isFirst && (
            <li>
              <Link to={prevPage} rel="prev">
                ← Previous
              </Link>
            </li>
          )}
          {numPages > 1 && Array.from({ length: numPages }, (_, i) => (
            <li key={`page-${i + 1}`} className=''>
              <Link
                to={getPageUrlI(pageContext, i + 1)}
                style={{ fontWeight: currentPage === i + 1 ? 'bold' : 'normal' }}
              >
                {i + 1}
              </Link>
            </li>
          ))}
          {!isLast && (
            <li>
              <Link to={nextPage} rel="next">
                Next →
              </Link>
            </li>
          )}
        </ul>
      </nav>
    </Layout>
  );
};

export default BlogIndex;

export const Head = ({ data, pageContext }: PageProps<IndexData, PageContext>) => {
  const { currentPage } = pageContext;
  const currentPageUrl = getCurrentPageUrl(pageContext);
  const { siteUrl } = data.site.siteMetadata;
  const pageTitle = currentPage === 1 ? pageContext.listName ?? 'Contents' : `${pageContext.listName ?? 'Contents'} | Page ${currentPage}`;
  

  return (
    <>
      <title>{pageTitle}</title>
      <meta name="description" content="Latest blog posts" />
      <link rel="canonical" href={`${siteUrl}${currentPage}`} />
    </>
  );
};

const getCurrentPageUrl = (pageContext: PageContext): string => {
  return pageContext.currentPage === 1 ? pageContext.pathPrefixRoot : `${pageContext.pathPrefixRoot}/page/${pageContext.currentPage}`
}

const getPrevPageUrl = (pageContext: PageContext): string => {
  return pageContext.currentPage - 1 === 1 ? pageContext.pathPrefixRoot : `${pageContext.pathPrefixRoot}/page/${pageContext.currentPage - 1}`;
  
}

const getNextPageUrl = (pageContext: PageContext): string => {
  return `${pageContext.pathPrefixRoot}/page/${pageContext.currentPage + 1}`;
}

const getPageUrlI = (pageContext: PageContext, i: number): string => {
  return i < 2 ? pageContext.pathPrefixRoot : `${pageContext.pathPrefixRoot}/page/${i}`;
}
