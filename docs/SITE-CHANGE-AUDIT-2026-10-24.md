# Local design changes versus committed code and production

Audit date: 24 October 2026. Reference commit: `3268adc`. No application fixes, commits or pushes were made during this audit.

## Subsequent local repairs

After the audit, the user authorized repairs. The findings below describe the earlier snapshot; the following fixes are now applied locally, without committing or pushing:

- Ahli K3 uses the shared soft hero; its description and actions are readable.
- In-house card labels pass a literal ampersand correctly.
- Self-referential palette declarations were removed from eleven tools stylesheets.
- Shared WhatsApp colours and the government-page action now provide stronger text contrast.
- The 404 recommendations use the shared poster manifest and real placeholder.
- The unavailable PHP schedule enhancement and obsolete fallback scripts were removed. All 352 imported city pages replace only their old schedule section with a shared build-rendered strip, using the same date generator as course pages. Programme content outside that section is preserved. Every city page was checked for four upcoming dates.
- Interaction testing uncovered missing legacy tool handlers. The original scripts for ten tools were recovered from `origin/main`, loaded only on their corresponding pages, and four implicit global-event dependencies were corrected. Tools' redundant inner main landmarks/duplicate skip-link IDs were removed.

Verification: build and application-source type checking pass (zero errors/warnings); 194 current page/viewport checks report no overflow, flagged hero contrast or runtime errors; 55 directory checks pass; all 1,603 existing pages retain the SEO metadata/H1/schema baseline. Calculator arithmetic/printing, JSA CSV/printing, risk register, APD filtering and canvas PNG downloads passed interaction tests. These representative interaction checks are not an exhaustive validation of every tool formula or regulatory statement. The repeatable interaction checks are in `scripts/verify-site-repairs.mjs`.

## Verdict

The shared-component direction is useful, and the current design preserves the checked SEO fields. The changes are **not ready for an unqualified whole-site approval**: a new contrast regression remains on the main Ahli K3 landing page, one new text-escaping bug remains, and existing tools-page defects were not solved by the migration.

The earlier statement that the shared hero covers 685 pages was overstated. That count matched CSS references in HTML. Parsing actual elements gives **185 pages with a rendered shared hero**, **306 with shared content cards**, and **136 with shared table scrolling**. These overlap. The navigation shell appears on 1,602 pages; the remaining HTML file is a standalone redirect. Existing course, article and imported city-content layouts are not all rebuilt with the new primitives.

## What was compared

- A clean source archive of `3268adc`, built separately, against the current local build.
- All **1,603 HTML files** in both builds: route presence, title, description, canonical, robots, H1, other heading text, structured data, main-content links, IDs, form actions and input identifiers.
- **91 changed tracked source files**, checking frontmatter after excluding import changes and normalizing line endings, plus inline JavaScript bodies. No application data/logic or inline script bodies changed in that comparison.
- Fresh production HTTP responses for **16 representative routes**, all HTTP 200. These cover home, catalogue, category, company, in-house, course, schedule hub, numeric batch, article, city hub, English, Chinese, resources and calculator families.
- **220 primary browser checks**: 97 local routes at 390 and 1,440 pixels (194 checks), plus 26 committed-version reference checks. Another 40 targeted checks investigated old versus new defects.
- Build, source type checking, the existing SEO/design linters and intercepted analytics tests.

This is a complete generated-HTML comparison against the reference commit and a representative live-site comparison. It is not a claim that every production URL was individually fetched or every screen visually reviewed. Automated contrast measurements were used to find candidates; the important landing-page and tools defects were also inspected in screenshots.

## Findings requiring attention

### 1. New: dark description on the Ahli K3 landing-page hero

Priority: high. Route: `/ahli-k3-umum/`.

The former light hero was put onto the new default dark `HeroSurface`. The page's `.ak-hero-sub` still explicitly uses dark muted text. The description now has about **2.36:1** contrast against the dark hero, and is visibly difficult to read. The earlier committed version did not show this failure in the paired check.

Cause: [HeroSurface.astro](../src/components/shared/HeroSurface.astro) changes the background independently of page-owned descendant colours; [ahli-k3-umum.css](../public/assets/css/page/ahli-k3-umum.css) retains the old description colour.

Recommended correction: explicitly choose the shared soft appearance for this existing light-content layout, or give the dark appearance a coherent foreground-token contract. Apply the same rule to descriptions and secondary actions, rather than fixing only H1 colours.

### 2. New: literal entity text in in-house hub links

Priority: medium. Route: `/in-house-training/`.

The three hub links display `&amp;` as text instead of `&`. Moving text from HTML into an Astro component's string attribute introduced double escaping:

`label="Pelajari Detail Hub &amp; Penawaran →"`

Location: [in-house-training/index.astro](../src/pages/in-house-training/index.astro:160).

This is the only main-content text difference detected between the two complete builds. The URLs, headings and metadata remain unchanged. Use a JavaScript string containing the actual ampersand when passing the label prop.

### 3. Existing: tools-page colour variables are invalid

Priority: high for user experience. Examples: `/tools/`, `/tools/kalkulator-k3/`, `/tools/apd-selector/`, `/tools/jsa-builder/`.

Eleven tools stylesheets redefine shared variables as themselves, for example:

```css
--slate-900: var(--slate-900);
```

CSS custom-property cycles invalidate these values. This removes some intended backgrounds while white text remains, leaving headings/descriptions and parts of the calculator results almost invisible. Header and contact surfaces can also be affected because these are global root declarations.

Example: [tools-kalkulator-k3.css](../public/assets/css/page/tools-kalkulator-k3.css:8).

Paired screenshots confirm this problem already exists in the reference build. The shared-component migration did **not** fix it. Remove self-referential palette declarations and use the shared tokens directly; then check the actual tools and their results, not just their hero headings.

### 4. Existing: bright green buttons have weak text contrast

Examples include fresh-graduate/free-training pages, event-organizer, service-training pages, renewal, inspection and retirement-training pages. White text on the bright WhatsApp green measured about **1.98:1** in several hero CTAs. Paired reference checks confirm examples predate this pass.

These buttons still use several legacy classes and inline styles. They are evidence that centralization remains incomplete. Migrate them to a shared action variant with adequate contrast, preserving their existing WhatsApp destinations and message context.

### 5. Existing: optional live schedule refresh endpoint returns 404

The browser requested `/api/public-schedules.php` from course and schedule pages. A direct production request with `training_slug=ak3-bnsp` returned HTTP 404 as well.

The enhancement code catches this failure and retains the complete server-rendered schedules, so the visible schedule is not removed. This is not a new regression from the current styling pass, but the live-refresh mechanism should not be described as working.

Location: [courseSchedulesClient.ts](../src/lib/courseSchedulesClient.ts:15). Either provide the intended endpoint or retire/replace the redundant refresh mechanism while keeping generated schedules.

### 6. Existing: missing images on the 404 page

Both reference and local browser checks request five missing image paths: `/assets/img/default-training.jpg` and four root-level hashed PNG paths. The default image and one sampled hashed PNG were also confirmed HTTP 404 on production.

This was not caught by the existing internal-link audit, which is not a complete image-resource audit. The 404 page's recommended-training images need valid shared image paths and a real fallback.

## What improved

| Area | Earlier committed code | Current local code |
| --- | --- | --- |
| In-house family | Four separate stylesheets and repeated hero/card/CTA markup | Shared hero, cards, actions, section headings, section shells and closing CTA; one family stylesheet |
| Company page | Separate hero action styles; obsolete breadcrumb offset | Explicit shared soft hero, readable actions, shared content cards and corrected breadcrumb spacing |
| English/Chinese hubs on mobile | Observed 348px / 328px horizontal overflow at a 390px viewport | No horizontal page overflow in their current checks |
| Data tables | Several page-owned tables could force wider layouts | Shared focusable horizontal-scroll wrapper; headers and cell text preserved |
| Theme | Palette/layout values repeated across pages | More control through semantic tokens, the shared theme and component primitives |
| In-house document structure | Nested `main` landmarks on four pages | Removed the four redundant nested landmarks |

All **194 current browser checks** completed without horizontal page overflow or uncaught JavaScript errors. This does not imply every colour, interaction or external resource is correct.

Navbar and footer were already shared before this particular pass; they should not be counted as newly migrated work.

## SEO findings

Against `3268adc`, all 1,603 generated routes remain present. No differences were found in the compared titles, descriptions, canonicals, robots, H1s, other heading text, structured data, main-content link destinations, form actions or input identifiers.

Across the 16 freshly fetched live pages, title, description, canonical, robots, H1, other heading text and structured data also match the local build. Two live link-list differences are Cloudflare email-obfuscation URLs, not removed programme links. Cached web-reader versions initially showed older content, so the fresh HTTP responses were used for the comparison.

The existing SEO linter reports the same **95 raw flags** on the reference and local builds. These are not 95 newly introduced SEO defects:

- 94 numeric schedule pages canonicalize to their related programme schedule URLs. The linter assumes every page needs a self canonical, so it flags these. This needs an intentional indexing policy, not an automatic canonical rewrite during visual work.
- The safety-talk H1 flag counts an H1 inside a JavaScript-generated print-document string. The actual rendered page has one H1 in the browser. This is a linter false positive.

The static SEO audit reports zero broken internal anchor destinations, missing OG images, invalid JSON-LD, reciprocal-hreflang failures or missing image alt attributes. The missing 404 image files demonstrate why passing those checks is not the same as a fully healthy site.

No new technical SEO loss was detected in this comparison. Search rankings, Google indexing and production Core Web Vitals were not measured; no zero-impact ranking guarantee follows from these checks.

## Tracking and payload

The published GTM/GA scripts were exercised with collection requests intercepted. Tests passed for one page view, one `whatsapp_click` and one `generate_lead` on course registration, schedule-card and article CTA examples. Local traffic exclusion, explicit debug mode and an early queued click also passed. No test events were sent to GA. Receipt inside the user's GA dashboard was not independently verified.

The refactor adds no new JavaScript framework or application script-body changes. It does not automatically make page delivery smaller:

| Route | Reference HTML | Local HTML | Approximate gzip delta |
| --- | ---: | ---: | ---: |
| `/in-house-training/` | 35,609 bytes | 43,717 bytes | +749 bytes |
| `/perusahaan/` | 64,994 bytes | 68,931 bytes | +519 bytes |
| `/pelatihan/` | 597,118 bytes | 599,095 bytes | +440 bytes |

These are generated-file measurements, not live transfer timings or LCP results. The catalogue's large server-rendered listing already exists in the reference build. Browser tests deliberately blocked third-party media and analytics; they cannot establish production image-loading performance.

## Maintainability and verification limits

- The migration is a useful foundation, not complete removal of legacy styles. The new theme still overrides legacy selectors; `PageHeader`, `PageHero` and page styles retain overlapping responsibilities. The contrast regression demonstrates the risk.
- The raw design-linter total is 1,814 before and 1,821 locally. Inline forbidden-style occurrences decreased from 1,052 to 1,020, but other raw flags increased. The linter only recognizes variables defined in `tokens.css`, so locally scoped variables also produce false positives. These totals must not be presented as runtime defect counts.
- Existing nested main landmarks and duplicate `konten-utama` IDs remain in some tools pages. The four in-house fixes do not constitute a whole-site landmark cleanup.
- The source type check passed with zero errors, zero warnings and 11 hints using an audit config limited to application source. Both builds passed.
- The comparison preserved a source archive and machine-readable evidence under `output/full-audit/`. Generated reference sources were isolated from the application during checking.

## Recommended next order

1. Fix the newly introduced Ahli K3 hero contrast and in-house escaped labels.
2. Remove the existing tools token cycles, then verify tool inputs, results, print/download flows and contrast.
3. Consolidate the remaining legacy action variants with accessible text contrast.
4. Repair the 404 image paths and decide what to do with the unavailable optional schedule endpoint.
5. Continue page-family polish, keeping shared component contracts explicit. Repeat targeted interaction and SEO comparisons before any release.

Production was not changed by this audit.
