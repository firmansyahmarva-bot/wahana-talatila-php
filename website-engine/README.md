# Website Engine

One PHP 8.2+ codebase serving 50+ SEO subdomains from config + flat-file content.
No niche content lives here — this is the reusable engine only.

Read `/ai/AI_RULES.md` first. Every session touching this repo must read all of
`/ai/*.md` before making changes.

## Setup

None — zero external dependencies. Just PHP 8.2+ on PATH.

## Create a subdomain (config only, zero manual file editing)

```
php bin/create-subdomain.php name=BNSP theme=default domain=bnsp.example.com
```

Produces `/subdomains/bnsp/` — manifest, nav, pages, categories, products, FAQ, SEO
defaults, schema overrides, and a strategy audit trail (niche analysis, entity map) —
generated from a single Content Intelligence blueprint (`engine/Strategy/`).

By default this uses the `manual` provider (a placeholder stub — see
`ai/AI_RULES.md`). To generate real, researched subdomains: set
`content_intelligence_provider: ai` in `config/engine.yaml`, then fill in
`config/ai.yaml` (`enabled: true`, `endpoint`, `model`) and set the `AI_API_KEY`
environment variable it references. Any OpenAI-compatible chat-completions backend
works — no provider is hardcoded (`engine/AI/HttpAiClient.php`). Every AI-generated
Blueprint passes through `Engine\Strategy\QualityGate` before a subdomain is written,
which enforces `ai/AI_RULES.md` in code (drops thin pages, resolves keyword
cannibalization, prunes orphaned links) rather than trusting the model's compliance.

## Run locally

```
php -S localhost:8080 -t public
```

Then visit `http://{slug}.localhost:8080/` (the resolver matches subdomains by
`domain:` in each manifest, with a `{slug}.localhost` dev convenience fallback).

## Architecture

- `/engine` — the one codebase: routing, content, SEO, linking, rendering, theming,
  the Content Intelligence Pipeline, and the subdomain generator. Never
  subdomain-aware.
- `/subdomains/{slug}` — everything that makes one subdomain what it is: manifest,
  content (Markdown pages + YAML/JSON structured data), nav, SEO defaults, schema
  overrides.
- `/templates` — one shared layout + component library, used by every subdomain.
- `/themes/{name}` — design tokens compiled to CSS variables.
- `/ai` — governance docs read before any change.
