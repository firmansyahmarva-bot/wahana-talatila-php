# Project Memory

## What this is
A single PHP 8.2+ codebase (`/engine`) that serves 50+ SEO subdomains via wildcard
DNS + host-based config resolution. A subdomain is a folder under `/subdomains/{slug}/`
— manifest + content + nav + SEO config. No database in v1; flat files (Markdown for
long-form, YAML/JSON for structured data).

## Why these choices
- **Plain PHP, no framework**: fast to deploy on existing shared/VPS hosting, no
  build step beyond theme token → CSS compilation.
- **Flat files over DB**: git-versionable, no infra needed before subdomain #1, and
  the eventual AI content pipeline just writes files — no ORM/migrations.
- **Single Content Intelligence Pipeline** (not per-stage AI providers): one blueprint
  call per subdomain minimizes AI token usage versus chaining separate research /
  keyword / content / FAQ / linking calls.
- **Generator, not hand-built folders**: `bin/create-subdomain.php` is the only
  sanctioned way to create a subdomain, so structure never drifts between subdomains.

## Key seams (where future capability plugs in without engine changes)
- `Engine\Strategy\Contracts\ContentIntelligenceProviderInterface` — `Manual` (stub)
  and `Ai` (`AiBlueprintProvider`, live) both implement it; selected by
  `config/engine.yaml: content_intelligence_provider`. Same `Blueprint` shape consumed
  by the generator either way.
- `Engine\AI\Contracts\AiClientInterface` — the only place a model is called. No
  provider name (Claude/ChatGPT/Gemini/etc.) appears anywhere in the engine.
  `HttpAiClient` talks to any OpenAI-compatible chat-completions endpoint, entirely
  configured via `config/ai.yaml` + an env var for the API key. Swapping models or
  hosts is a config change.
- `Engine\Strategy\QualityGate` — runs after every provider (Manual or AI) and before
  `SubdomainGenerator`. Enforces AI_RULES.md in code, not just via prompt: drops thin
  pages (outline < 3 sections), resolves keyword cannibalization (first claim wins),
  attaches orphaned pages to the pillar, prunes the topical map to match. This is why
  "reduce pages instead of weak content" is guaranteed rather than merely requested.
- `Engine\Content\ContentRepository` — swap flat-file reads for a DB-backed
  implementation later without touching SEO/render/linking code.
- `ContentRepository::homepage()` reads `content/homepage.yaml` — presentation
  content for the `home` layout's 12 marketing sections (hero, categories,
  pillars, guides, products, trust, process, FAQ preview, footer columns, final
  CTA). Deliberately separate from `Engine\Strategy\Blueprint` (the SEO content
  strategy contract) — this is per-page marketing copy, not topical/keyword
  strategy, and follows the same pattern as categories()/products()/faqs().

## Homepage template (`home` layout)
Approved master homepage design implemented as `templates/layouts/home.php` +
12 components named `home-header`, `home-hero`, `home-search`,
`home-categories`, `home-pillars`, `home-guides`, `home-products`, `home-trust`,
`home-process`, `home-faq`, `home-finalcta`, `home-footer` (registered in
`ComponentRegistry`). Deliberately separate files from the existing
`header.php`/`footer.php` used by page/category/product/faq layouts — the
approved redesign was scoped to the homepage only, so other routes are
untouched. Each `home-*` component renders nothing if its corresponding
`homepage.yaml` array is empty (e.g. trust section auto-hides when no
stats/clients/accreditations are supplied) — visibility is data-driven, not
just the `component_flags` toggle. Identity/contact (brand, logo, phone,
email, address, social links) comes from `manifest.yaml`, never from
`homepage.yaml`, so it's reusable by any future component (schema, header,
footer) without duplication.

Two deliberate omissions from the source artifact, both dev/demo-only chrome:
the floating blueprint config-panel (redundant — real section toggling is
already server-side via `manifest.component_flags`) and the `.spec-tag`
"Component — X · source: blueprint.y[]" developer annotations (internal
labeling, not production copy).

Styling lives in `public/assets/site.css` (static, hand-authored, not
compiled) plus additive theme tokens in `themes/default/tokens.yaml`
(`paper`/`ink`/`card`/`line`/`gold`/`home-accent`/etc. colors, `radius`,
`shadows` — `ThemeLoader` was extended to compile those two new groups the
same way it already compiles colors/fonts/spacing). The existing
`--color-accent` used by other layouts was left untouched; the homepage's
distinct teal brand color is `--color-home-accent` to avoid bleeding into
other pages.

## Standing rule
Never edit `/engine` to solve a single subdomain's problem. If it looks necessary,
the real gap is in the engine's genericness — raise it, don't patch around it.
