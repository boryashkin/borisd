
export const IndexMetadataDeclaration = `
type IndexMetadata implements Node {
  id: ID!
  path: String!
  pathPrefix: String!
  title: String!
  date: String!
  description: String
}
`

export interface IndexMetadataNodeValue {
    id: string;
    path: string; // /blog/one/two
    pathPrefix: string; // blog
    title: string;
    description: string|undefined;
    date: string;
}

export function getPathPrefix(path: string): string {
    const segments = path.split("/").filter(Boolean) // removes empty strings
    return segments.length > 1 ? segments[0] : ""
}