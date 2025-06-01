
import React from "react"

export default function BlogWrapper({ children, title, publishedAt }: {children: any, title: string, publishedAt: string}) {
    return (
      <>
        <div className="mb-5">
            <h1 className="text-2xl font-bold">{title}</h1>
            <small><i>Published at: {new Date(publishedAt).toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric',
                })}</i></small>
        </div>
        {children}
        
      </>
    )
}