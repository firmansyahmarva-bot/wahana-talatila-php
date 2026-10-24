# Shared website components

These changes are local previews. They have not been committed or pushed.

## Where to change the design

| Control | Source |
| --- | --- |
| Palette and language-specific fonts | `public/assets/css/tokens.css` |
| Current red theme and site-wide typography | `public/assets/css/site-theme.css` |
| Industrial side imagery and tint | `public/assets/css/site-safety-background.css` |
| Navigation, mobile navigation, footer, contact dock | `src/layouts/BaseLayout.astro` and its shared shell components |
| Hero background, including legacy hero layouts | `src/components/shared/HeroSurface.astro` |
| Standard catalogue and in-house hero structure | `src/components/shared/PageHero.astro` |
| Standard actions | `src/components/shared/ActionLink.astro` |
| Text/content cards | `src/components/shared/SurfaceCard.astro` |
| Section heading typography and spacing | `src/components/shared/SectionHeading.astro` |
| Section padding, container and surface | `src/components/shared/ContentSection.astro` |
| Closing registration / enquiry section | `src/components/shared/CallToAction.astro` |
| Accessible horizontal scrolling for tables | `src/components/shared/TableScroll.astro` |
| In-house programme-specific grids and lists | `public/assets/css/page/in-house-shared.css` |

`DirectoryHeader` is a compatibility adapter for `PageHero`. Existing listing pages keep their API, content, breadcrumbs and filter behaviour. `PageHeader` uses `HeroSurface`, with a separate photo appearance that preserves optimized images and their contrast overlay.

All four Indonesian in-house pages use the shared hero, actions, content cards, section headings, section shell, FAQ and closing call to action. Their four former page stylesheets were replaced by one family stylesheet. Programme copy and location information remain on their pages.

## Coverage and limits

The generated output contains 1,603 HTML files: 1,602 use the shared navigation shell; one is a standalone redirect. Parsing actual rendered elements gives 185 pages with the shared hero surface, 306 with the content card primitive, and 136 with table scrolling. These counts overlap and are not a total of redesigned pages. The earlier hero count included CSS references and was incorrect.

Course, schedule, article, homepage, training-card and directory components retain their specialized layouts. They already share components within their own families. Raw imported city-programme content remains intact. This migration does not mean every remaining legacy card, button or inline layout has been rewritten; those can be migrated to the appropriate primitive without replacing their content or functionality.

## Verification

- Static build: 1,602 generated pages plus the public redirect.
- SEO comparison: title, metadata, canonical, H1 and structured data unchanged on all 1,603 existing HTML files.
- Responsive browser checks: 14 representative routes at 320, 390 and 1,440 pixels; 42 checks passed, including filters, no horizontal page overflow and no desktop artwork download on mobile.
- Directory regression checks: another 55 responsive checks passed, covering progressive loading, filters, WhatsApp context and no-JavaScript listings. All 352 imported city-programme HTML bodies were preserved.
- Browser screenshots and migration inventories are under `output/shared-components` and `output/shared-component-*.json`.

These checks establish technical preservation, not a guarantee about future search rankings or a visual review of every URL.
