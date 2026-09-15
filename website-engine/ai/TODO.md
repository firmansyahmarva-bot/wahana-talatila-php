# TODO

## Done
- [x] Engine skeleton: Core, Content, SEO, Linking, Render, Theme, Strategy, Generate
- [x] Manual (stub) Content Intelligence provider
- [x] `bin/create-subdomain.php` generator
- [x] Shared template/component library (base + page/category/product/faq layouts)
- [x] Default theme tokens
- [x] Smoke-tested end to end (generator → render → sitemap/robots/schema), test
      subdomain removed after — no niche content shipped
- [x] AI Content Intelligence provider (`AiBlueprintProvider`) + model-agnostic
      `AiClientInterface`/`HttpAiClient`/`AiClientFactory` + `QualityGate` enforcing
      AI_RULES.md (thin-page removal, cannibalization resolution, orphan pruning)
- [x] Approved master homepage template implemented as a `home` layout + 12
      `home-*` components, data-driven from `content/homepage.yaml`, each section
      independently toggleable via `manifest.component_flags`. Verified responsive
      at mobile/tablet/desktop. First real subdomain shipped:
      `subdomains/wahana-totalita-konsultan/` — real identity/contact/logo/social
      in `manifest.yaml`, generic placeholder marketing copy in `homepage.yaml`.

## Pending
- [ ] Configure `config/ai.yaml` (endpoint, model, `AI_API_KEY` env var) against a real
      OpenAI-compatible backend and run a live `create-subdomain` end to end
- [ ] Admin/editing UI (only if flat-file editing becomes a bottleneck)
- [ ] DB-backed `ContentRepository` implementation (only if needed — flat files are v1)
