# Shared course and schedule templates

`data/trainings/{slug}.json` is the single course-data source for the Astro site. The `trainings` content collection and `src/lib/trainingCatalog.ts` both read these records. Change a course name, price, duration, certification, description or curriculum here; rebuilding updates course pages, schedule-slug pages, the schedule index and calendar together. Batch-specific dates and overrides remain in the existing batch data and schedule configuration. The aggregate `data/trainings.json` is retained for external compatibility; Astro schedule pages no longer read it.

## Shared presentation

`/pelatihan/{slug}/`, `/jadwal/{slug}/` and numeric `/jadwal/{id}/` pages use `components/pelatihan/CourseFrame.astro`. The frame owns the shared stylesheet, hero, registration, section navigation, schedule cards and in-house enquiry. Edit these components once for both page types:

- `CourseHero`: title, introduction and existing generated poster. Schedule pages provide their schedule title and poster variant.
- `CourseRegistration`: price, next date and individual registration.
- `CourseSchedules`: batch dates and direct WhatsApp registration. Course pages link to the related schedule-slug page; schedule pages omit the self-link.
- `CourseInhouse`: corporate enquiry and proposal request.
- `CourseSectionNav`: navigation between page sections.
- `CourseCurriculum`: course curriculum from the shared record.
- `CourseGuide`: sticky enquiry panel.
- `CourseFaq`: native FAQ disclosures on course pages.

All shared styling lives in `public/assets/css/course-experience.css`. Header, footer and mobile navigation remain owned by `BaseLayout`. Avoid creating a separate schedule stylesheet or copying component markup back into either route.

## Page-specific content and SEO

`CourseDetail.astro` retains the course's long-form content, recommendations, FAQ and Course schema. `components/jadwal/ProgramSchedulePage.astro` composes the schedule-specific body using the shared frame. `lib/schedulePage.ts` retains existing schedule titles, descriptions, canonicals and EducationalEvent schemas. Schedule posters and Open Graph images retain their existing mapping. Visual sharing does not merge either page's SEO identity.

`pages/jadwal/[id].astro` only dispatches routes. Numeric pages use `components/jadwal/BatchSchedulePage.astro` with the same shared frame and `ScheduleContent` body as program schedule pages. They preserve their existing metadata and canonical behaviour while overriding course price, mode and venue with the selected batch values. A `BatchDetails` date panel replaces the general course poster to avoid displaying a course price printed into an image that differs from the batch price. The selected date uses `data-course-selected-date`; only the upcoming schedule grid and `data-course-next-date` may update from the live feed. Never bind the selected batch date to the next generated course date.

## Behaviour and verification

All batch registration links go directly to WhatsApp with the course and date. `lib/courseSchedulesClient.ts` progressively updates dates from the existing public feed; feed-provided batch URLs must not replace direct registration. Server-rendered schedules work if the API or JavaScript is unavailable. Inactive archived courses omit schedule directory links because those routes are not generated.

Run `npm run build`, `npm run check` and `node scripts/verify-course-experience.mjs`. To compare SEO before a change, build the baseline and run the verification script with `--capture-baseline`, then rebuild and run normally. The script checks the complete route set, metadata/H1/schema equality, course/schedule data parity, responsive layouts, registration, reduced motion and no-JavaScript fallbacks. Reports and screenshots go under `output/course-redesign/`. Run `npm run seo:audit` separately and distinguish existing issues from regressions.
