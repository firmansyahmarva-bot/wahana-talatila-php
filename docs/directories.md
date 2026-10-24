# Shared discovery and listing pages

`DirectoryHeader`, `DirectoryExplorer`, `ScheduleCard`, `DirectoryLinkCard`, `DirectoryInhouse` and `DirectoryContext` live in `src/components/directory`. Training cards reuse the existing `TrainingCard` across catalogues, category hubs, articles and other programme lists. The card's next date comes from the same `getUpcomingBatches` helper as the course pages, with a build-time cache.

The shared explorer powers `/pelatihan/`, `/jadwal/`, the four training category hubs, `/kota/`, and programme choices on the 28 city hubs. Existing city-course exports use a shared presentation stylesheet and shared contextual navigation; their 352 HTML bodies remain intact. No city-specific page copies were introduced.

## Progressive discovery

All cards and links render in static HTML. Without JavaScript, every item remains visible. With JavaScript, the explorer reveals 24 matches at a time, supports loading more, and provides labelled search, category, method, month and sort controls where applicable. Reset restores the default ordering and count. The URL retains filters so results can be shared; the existing base canonical stays unchanged.

`both` courses match Online and Tatap muka filters. Unknown prices sort after known prices; no zero-price offer is invented. Schedule cards display the original generated batch dates and prices, retain course/batch links, and register directly through WhatsApp with programme/date/method context. The cron and schedule generation rules were not changed.

## Styles and future work

`directory-experience.css` holds the shared design and uses site tokens. Older long-form catalogue, category and city content keeps separate compatibility stylesheets; its inline presentation rules were moved out of templates. New listings should use the shared components rather than copying a page or adding inline CSS. Legacy city-course HTML is still a content export; migration to structured blocks can be done separately without changing the directory API.

## Verification

Build and typecheck with `npm run build` and `npm run check`. Run `node scripts/verify-directory-experience.mjs` for filtering, progressive loading, no-JavaScript discovery, preserved city content and responsive checks. Run `node scripts/verify-course-experience.mjs --seo-only` against the pre-change baseline to compare metadata, H1 text, schemas and existing routes. Browser checks require Playwright Chromium. Do not replace the pre-change baseline after implementation.

This release compares all 1,603 existing HTML files. The SEO audit retains 95 pre-existing mechanical issues and zero broken internal links; it is not an assurance of search ranking outcomes.
