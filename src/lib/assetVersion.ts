import { createHash } from 'node:crypto';
import { readFileSync } from 'node:fs';
import { resolve } from 'node:path';

const versions = new Map<string, string>();

/** Give mutable public styles a new URL whenever their contents change at build time. */
export function versionStylesheet(href: string): string {
  if (!href.startsWith('/assets/css/') || !href.endsWith('.css')) return href;
  let version = versions.get(href);
  if (!version) {
    version = createHash('sha256')
      .update(readFileSync(resolve(process.cwd(), 'public', href.slice(1))))
      .digest('hex').slice(0, 12);
    versions.set(href, version);
  }
  return `${href}?v=${version}`;
}
