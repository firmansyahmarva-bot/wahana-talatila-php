# SEO Rules

Enforced by `Engine\SEO\SeoEngine` — do not duplicate this logic elsewhere.

- Every page has exactly one canonical URL, computed by `CanonicalResolver`, never
  hardcoded in content.
- Title template default: `{page_title} | {brand}` — overridable per-subdomain in
  `seo/defaults.yaml`, never per-page in code.
- Every page emits JSON-LD via `SchemaEngine`. Type comes from `seo/defaults.yaml`
  (`Organization`, `Product`, `FAQPage`, `BreadcrumbList`, `Article`) — never hardcoded
  in a template.
- Breadcrumbs are generated from the route hierarchy (pillar → cluster → page), never
  authored by hand.
- Internal links follow `InternalLinkEngine` rules: pillar pages link to all their
  clusters; clusters link back to their pillar and to 2–4 sibling clusters; no orphan
  pages (every generated page must have at least one inbound internal link).
- Sitemap and robots.txt are generated per-subdomain from `ContentRepository` — never
  hand-maintained.
