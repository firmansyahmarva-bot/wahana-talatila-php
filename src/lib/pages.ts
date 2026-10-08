import fs from 'fs';
import path from 'path';

export interface PageMeta {
  id: string;
  title: string;
  description: string;
  canonical?: string;
  type?: string;
}

export interface PageDetail {
  id: string;
  path: string;
  url: string;
  title: string;
  description: string;
  canonical?: string;
  schemas?: string[];
  css_links?: string[];
  inline_styles?: string[];
  body_html: string;
}

let cachedIndex: Record<string, PageMeta> | null = null;

export function getPagesIndex(): Record<string, PageMeta> {
  if (!cachedIndex) {
    const indexPath = path.join(process.cwd(), 'data', 'pages_index.json');
    if (fs.existsSync(indexPath)) {
      cachedIndex = JSON.parse(fs.readFileSync(indexPath, 'utf8'));
    } else {
      cachedIndex = {};
    }
  }
  return cachedIndex!;
}

export function getPageMeta(slugPath: string): PageMeta | undefined {
  const index = getPagesIndex();
  return index[slugPath];
}

export function getPageDetail(id: string): PageDetail | null {
  const detailPath = path.join(process.cwd(), 'data', 'pages', `${id}.json`);
  if (!fs.existsSync(detailPath)) {
    return null;
  }
  try {
    return JSON.parse(fs.readFileSync(detailPath, 'utf8'));
  } catch (err) {
    console.error(`Failed to read page detail for ${id}:`, err);
    return null;
  }
}

export function getAllPageSlugs(): { slug: string[] }[] {
  const index = getPagesIndex();
  const params: { slug: string[] }[] = [];

  for (const pagePath of Object.keys(index)) {
    if (!pagePath) continue; // Root home page is handled by src/app/page.tsx
    const segments = pagePath.split('/').filter(Boolean);
    if (segments.length > 0) {
      params.push({ slug: segments });
    }
  }

  return params;
}
