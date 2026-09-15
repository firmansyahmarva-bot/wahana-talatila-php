# AI Rules — permanent brain, read first every session

Hard constraints, not suggestions. Read all `/ai/*.md` before changes; update
`CHANGELOG.md` + `TODO.md` after.

## Mission
Maximize qualified organic search traffic and generate business leads through
sustainable white-hat SEO. Think like an elite Technical SEO, Content
Strategist, Information Architect, and Conversion Optimizer — for every
subdomain, every time.

## Engine constraints (never violate)
1. **Config-driven only.** A subdomain is a folder under `/subdomains/{slug}/`.
   Nothing in `/engine` references a slug, brand, or niche. If a fix seems to
   need an `/engine` edit for one subdomain, stop — it belongs in that
   subdomain's config, or it's a real generic gap to raise, not patch around.
2. **No duplicate templates.** One `/templates/layouts`, one
   `/templates/components`. Variance = theme tokens + manifest flags, never
   forked files.
3. **No duplicate SEO/schema/linking logic.** `Engine\SEO\SeoEngine` and
   `Engine\Linking\InternalLinkEngine` are the only place metadata, JSON-LD,
   canonicals, sitemap, robots, breadcrumbs, internal links are computed.
4. **Subdomains are generated, not hand-built.** Use `bin/create-subdomain.php`.
5. **One blueprint contract, one pipeline.** `Engine\Strategy\Blueprint` +
   `ContentIntelligencePipeline`. Swap providers behind
   `ContentIntelligenceProviderInterface`; never add parallel generation paths.
6. **No niche content in the engine.** Example niches are illustrative only —
   no niche-specific code, copy, or assumptions in `/engine`, `/templates`,
   `/themes`.
7. **Minimum AI token usage.** One blueprint call per subdomain, not chained
   research/keyword/content/FAQ/linking calls.

## SEO & content doctrine (applies to every Blueprint)
- Structure before content: resolve the full topical map and site architecture
  first, then generate pages against it — never the reverse.
- Build complete topical authority: cover every important search intent in the
  niche, not just the easy or obvious ones.
- Pillar/cluster architecture is mandatory. Every cluster links to its pillar;
  every pillar links to all its clusters; no orphan pages.
- Internal linking must read as natural and purposeful, not mechanical.
- One page per intent/keyword target. Never create two pages competing for the
  same query (cannibalization) or overlapping/duplicate content.
- Every page must earn its existence: real ranking potential and a clear role
  in topical authority. Never create a page just to raise the page count.
- No thin pages. No keyword stuffing — one primary keyword per page, supporting
  keywords used naturally.
- Titles, headings, URLs, metadata, and entities are optimized naturally for
  the target query — never forced or robotic.
- Apply schema automatically per `SeoEngine`/`SchemaEngine` — never bespoke
  per-page schema.
- Optimize for qualified-visitor intent, not raw traffic — every page should
  attract readers likely to convert into leads.
- Never fabricate facts, certifications, testimonials, or statistics. If real
  data isn't available, say so or omit — never invent it.
- Follow Google Webmaster Guidelines and white-hat SEO practice; no
  manipulation, cloaking, or spam tactics.
- Topical completeness over page quantity, always.

## Pre-generation quality gate
Before a Blueprint is finalized and handed to `SubdomainGenerator`, run an
internal review: is the topical map complete, is the architecture sound, is
every page justified, is anything thin/duplicate/cannibalizing? Fix issues in
the Blueprint before generation — never ship a subdomain built from a
Blueprint that failed this check.
