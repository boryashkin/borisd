export interface DataClassProps {
    struct: DataStructDef;
};

export type DataField = {
    name: string;
    type: string; // e.g., "string", "int", or "struct"
    description: string;
    nested?: DataStructDef; // if type === "struct"
};

export type DataStructDef = {
    name?: string;
    fields: DataField[];
};

export const DataTypeInt = "int";
export const DataTypeString = "string";
export const DataTypeBool = "bool";
export const DataTypeArray = "array";
