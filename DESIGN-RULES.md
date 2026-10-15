# Design & Code Alignment Rules

1. Pages and components use semantic tokens only (`var(--brand)`, `var(--cta)`, `var(--surface)`...). No hex, no raw palette tokens, outside `tokens.css`.
2. Never style bare elements globally (`a`, `button`, `h2`...). Use classes.
3. Never redefine an existing class in another file. New classes get unique names; check with grep first.
4. White on colored backgrounds = `var(--on-brand)` / `var(--on-cta)`.
5. Orange = `var(--cta)`. `--warning` is for warning states only.
6. Run `npm run build`, `npm run check` and `npm run lint:design` before every commit.
7. Breakpoints in use: 640 / 768 / 1024 (legacy ones are being migrated).
