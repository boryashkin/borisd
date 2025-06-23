
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
    pathPrefix: string; // blog // DEPRECATED
    pathPrefixes: string[];
    title: string;
    lang: string;
    description: string|undefined;
    date: string;
}

export function getPathPrefix(path: string): string {
    const segments = path.split("/").filter(Boolean) // removes empty strings
    return segments.length > 1 ? segments[0] : ""
}

export function getPathPrefixes(path: string): string[] {
    const segments = path.split("/").filter(Boolean); // removes empty strings
    const prefixes = [];

    for (let i = 1; i < segments.length; i++) {
        prefixes.push(segments.slice(0, i).join("/"));
    }

    return prefixes;
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

// don't use concatenation, only string literals, as the static analysis doesn't pick up concatenated strings
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
      pathPrefixes: getPathPrefixes(path),
      title: b.title,
      lang: b.lang,
      description: b.description,
      date: b.date,
  }
}