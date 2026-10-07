import React from "react";
import type { Metadata } from "next";
import { notFound } from "next/navigation";
import fs from "fs";
import path from "path";

export async function generateStaticParams() {
  const indexPath = path.join(process.cwd(), "data", "pages_index.json");
  const index = JSON.parse(fs.readFileSync(indexPath, "utf8"));
  const params: { slug: string[] }[] = [];

  for (const p of Object.keys(index)) {
    if (!p) continue; // home page is handled by src/app/page.tsx
    const segments = p.split("/").filter(Boolean);
    if (segments.length > 0) {
      params.push({ slug: segments });
    }
  }

  return params;
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string[] }>;
}): Promise<Metadata> {
  const { slug } = await params;
  const pagePath = slug.join("/");
  const indexPath = path.join(process.cwd(), "data", "pages_index.json");
  const index = JSON.parse(fs.readFileSync(indexPath, "utf8"));
  const meta = index[pagePath];

  if (!meta) {
    return {};
  }

  return {
    title: meta.title,
    description: meta.description,
    alternates: {
      canonical: meta.canonical || `https://wahanatotalita.com/${pagePath}/`,
    },
    openGraph: {
      title: meta.title,
      description: meta.description,
      url: meta.canonical || `https://wahanatotalita.com/${pagePath}/`,
      type: "article",
    },
  };
}

export default async function CatchAllPage({
  params,
}: {
  params: Promise<{ slug: string[] }>;
}) {
  const { slug } = await params;
  const pagePath = slug.join("/");
  const indexPath = path.join(process.cwd(), "data", "pages_index.json");
  const index = JSON.parse(fs.readFileSync(indexPath, "utf8"));
  const item = index[pagePath];

  if (!item) {
    notFound();
  }

  const detailPath = path.join(process.cwd(), "data", "pages", `${item.id}.json`);
  if (!fs.existsSync(detailPath)) {
    notFound();
  }

  const data = JSON.parse(fs.readFileSync(detailPath, "utf8"));

  return (
    <>
      {data.css_links?.map((href: string, idx: number) => (
        <link key={idx} rel="stylesheet" href={href} />
      ))}
      {data.inline_styles?.map((css: string, idx: number) => (
        <style key={idx} dangerouslySetInnerHTML={{ __html: css }} />
      ))}
      {data.schemas?.map((s: string, idx: number) => (
        <script
          key={idx}
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: s }}
        />
      ))}
      <div
        dangerouslySetInnerHTML={{ __html: data.body_html }}
        suppressHydrationWarning
      />
    </>
  );
}
