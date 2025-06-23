import React from 'react';
import { Remark } from 'react-remark';

// Optional: Import PrismJS styles for code highlighting
// import 'prismjs/themes/prism.css';

// Define props interface
interface InlineMarkdownProps {
  markdown: string;
}

const InlineMarkdown: React.FC<InlineMarkdownProps> = ({ markdown }) => {
  return (
    <Remark
      //remarkPlugins={[require('remark-prism')]} // Optional: For code highlighting
      rehypeReactOptions={{
        components: {
          // Customize markdown elements
          h1: (props: React.HTMLProps<HTMLHeadingElement>) => (
            <h1 className="text-2xl my-5" {...props} />
          ),
          h2: (props: React.HTMLProps<HTMLHeadingElement>) => (
            <h2 className="text-xl my-5" {...props} />
          ),
          h3: (props: React.HTMLProps<HTMLHeadingElement>) => (
            <h2 className="text-lg my-5" {...props} />
          ),
          ul: (props: React.HTMLProps<HTMLUListElement>) => (
            <ul className="ml-5 list-disc mb-5" {...props} />
          ),
          code: (props: React.HTMLProps<HTMLElement>) => (
            <code className="language-jsx" {...props} />
          ),
          pre: (props: React.HTMLProps<HTMLPreElement>) => (
            <pre className="prism-code" {...props} />
          ),
        },
      }}
    >
      {markdown || '' /* Fallback to empty string */}
    </Remark>
  );
};

export default InlineMarkdown;