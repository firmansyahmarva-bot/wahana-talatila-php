# Changelog

## 2026-07-20 — Engine v1 skeleton
- Initial architecture: config-driven engine, one codebase, wildcard subdomain routing.
- Added `/ai` governance layer (this directory).
- Added Content Intelligence Pipeline (single blueprint contract, Manual provider stub).
- Added `bin/create-subdomain.php` generator.
- Smoke-tested via generated test subdomains (removed after verification) — no niche
  content shipped.

## 2026-07-20 — AI Content Intelligence provider
- Rewrote `ai/AI_RULES.md` as the permanent SEO/content doctrine (mission, engine
  constraints, content rules, pre-generation quality gate).
- Extended `Blueprint` with niche analysis, entity map, category structure,
  product/service structure, and schema blueprint (all optional, backward-compatible).
- Added `Engine\AI\Contracts\AiClientInterface` — the only seam for talking to a model.
  No provider (Claude/ChatGPT/Gemini) is named anywhere in the engine.
- Added `Engine\AI\HttpAiClient` (generic OpenAI-compatible chat-completions client),
  `NullAiClient` (fails clearly when unconfigured), `AiClientFactory` (reads
  `config/ai.yaml`).
- Added `Engine\Strategy\Providers\Ai\AiBlueprintProvider` — one prompt, one JSON
  response, one Blueprint. Loads `ai/AI_RULES.md` verbatim into the system prompt.
- Added `Engine\Strategy\QualityGate` — enforces AI_RULES.md in code after generation:
  removes thin pages (outline < 3 sections), resolves keyword cannibalization, prunes
  orphaned internal links, trims the topical map to match. Runs for every provider.
- `content_intelligence_provider: ai` in `config/engine.yaml` + `config/ai.yaml`
  switches the pipeline from the Manual stub to this provider — no engine code changes.
- Verified with a fake in-process `AiClientInterface` (4 candidate pages in, 1 thin +
  1 cannibalizing page correctly dropped, 2 legitimate pages generated) — test
  subdomain removed after verification.

## 2026-07-20 — homepage design review
- Generated a temp subdomain (manual provider, placeholder data) to render and
  screenshot the current homepage exactly as built — no engine changes. Subdomain
  removed after review.

## 2026-07-20 — approved master homepage template implemented
- Added `home` layout + 12 `home-*` components (header, hero, search, categories,
  pillars, guides, products, trust, process, faq, finalcta, footer), ported from
  the approved artifact. Registered in `ComponentRegistry`; `routes.home.layout`
  in `config/engine.yaml` switched from `page` to `home`.
- Added `ContentRepository::homepage()` reading new `content/homepage.yaml` —
  data source for all 12 sections, kept separate from `Engine\Strategy\Blueprint`.
- Extended `themes/default/tokens.yaml` (paper/ink/card/line/gold/home-accent
  colors, radius, shadows) and `ThemeLoader::compileCss()` (radius/shadow
  compilation, same pattern as colors/fonts/spacing) — additive, existing tokens
  and other layouts untouched.
- Added `public/assets/site.css` (static, hand-authored) for the new components.
- `base.php` now wraps non-header/footer slots in `<main id="main">` and adds a
  skip-link, for every layout (accessibility improvement, not visual).
- Fixed a responsive bug found during verification: `.header-inner` used a fixed
  `height:68px` which broke when the brand name wrapped on narrow screens
  (content overflowed instead of the header growing) — changed to `min-height`
  and added a mobile breakpoint hiding `nav.primary` (mirrors the artifact's own
  unused `.mobile-hint` intent). Verified at mobile/tablet/desktop widths.
- Omitted from the port (dev/demo-only chrome, not part of the design): the
  floating blueprint config-panel and `.spec-tag` developer annotations.
- Generated the subdomain `wahana-totalita-konsultan` via `bin/create-subdomain.php`
  (manual provider), then set real identity/contact facts in `manifest.yaml`
  (brand, logo, phone, email, address, Instagram — confirmed live from
  wahanatotalita.com on 2026-07-20, phone/email disambiguated with the site
  owner) and authored `content/homepage.yaml` with generic placeholder marketing
  copy (no claims about Wahana's actual services/stats/clients/certifications).
  No legal registration number was found published on the live site, so it was
  omitted rather than invented.

## 2026-07-20 — subdomain created: hse
- Generated via bin/create-subdomain.php name=hse
- Provider: manual

## 2026-07-21 — subdomain created: hse
- Generated via bin/create-subdomain.php name=hse
- Provider: manual
