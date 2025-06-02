
export const IndexMetadataDeclaration = `
type IndexMetadata implements Node {
  id: ID!
  path: String!
  pathPrefix: String!
  title: String!
  lang: String!
  date: String!
  description: String
}
`

export interface IndexMetadataNodeValue {
    id: string;
    path: string; // /blog/one/two
    pathPrefix: string; // blog
    title: string;
    lang: string;
    description: string|undefined;
    date: string;
}

export function getPathPrefix(path: string): string {
    const segments = path.split("/").filter(Boolean) // removes empty strings
    return segments.length > 1 ? segments[0] : ""
}

export interface PageContext {
  limit: number;
  skip: number;
  numPages: number;
  currentPage: number;
  pathPrefixRoot: string; // /section
  section: string; // section
  listName: string;
}

export interface PageMetadata {
  title: string;
  lang: string;
  description?: string;
  date: string;
}

export const metadataFieldsToNodeValues = (id: string, path: string, b: PageMetadata): IndexMetadataNodeValue => {
  return {
      id: id,
      path: path,
      pathPrefix: getPathPrefix(path),
      title: b.title,
      lang: b.lang,
      description: b.description,
      date: b.date,
  }
}