import { DataClassProps } from "./types";

export const DataStruct = ({ struct }: DataClassProps) => (
  <div>
  {struct.name && <h3 className="font-bold text-lg mb-2">{struct.name}</h3>}
  <table className="border-collapse border border-gray-400 text-sm">
    <thead>
      <tr className="bg-gray-100">
        <th className="border border-gray-400 px-2 py-1">Field</th>
        <th className="border border-gray-400 px-2 py-1">Type</th>
        <th className="border border-gray-400 px-2 py-1 font-light italic">Description</th>
      </tr>
    </thead>
    <tbody>
      {struct.fields.map((field, i) => (
        <tr key={i}>
          <td className="border border-gray-400 px-2 py-1">{field.name}</td>
          <td className="border border-gray-400 px-2 py-1">
            {field.nested ? (
              <DataStruct struct={field.nested} />
            ) : (
              field.type
            )}
          </td>
          <td className="border border-gray-400 px-2 py-1 font-light italic">
            {field.description}
          </td>
        </tr>
      ))}
    </tbody>
  </table>
</div>
);