import { IndexMetadataNodeValue, getPathPrefix } from "../index";

export interface BlogMetadata {
    title: string;
    description?: string;
    date: string;
}

export const metadataFieldsToNodeValues = (id: string, path: string, b: BlogMetadata): IndexMetadataNodeValue => {
    return {
        id: id,
        path: path,
        pathPrefix: getPathPrefix(path),
        title: b.title,
        description: b.description,
        date: b.date,
    }
}