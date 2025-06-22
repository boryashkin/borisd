export const Definition = ({ term, description }: { term: string, description: string }) => (
  <div className="definition py-2 my-3">
    <p className="definition-description border-dashed border-b">
        <span className="font-bold">{term}</span> — {description}
    </p>
  </div>
);