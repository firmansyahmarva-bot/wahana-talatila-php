# Course template

`src/components/pelatihan/CourseDetail.astro` owns course data and SEO output. Keep its title, description, canonical, Open Graph image, H1, FAQ content and schemas tied to the existing training record.

The display is split into reusable Astro components:

- `CourseHero`: existing generated poster, course title and introduction.
- `CourseRegistration`: price, next date and individual registration.
- `CourseSchedules`: course-specific schedule directory and batch registration.
- `CourseInhouse`: course-specific corporate enquiry and proposal request.
- `CourseSectionNav`: navigation between the page sections.
- `CourseFaq`: native accessible disclosure elements.

Style this template in `public/assets/css/course-experience.css`. Do not load or append overrides to the legacy `pelatihan-detail.css`. Header, footer and mobile navigation remain owned by `BaseLayout`.

All batch registration links go directly to WhatsApp with the course and date. The existing public schedule feed progressively updates dates through `src/lib/courseSchedulesClient.ts`; feed-provided batch URLs must not replace direct registration. Server-rendered schedules remain usable if the API or JavaScript is unavailable. Active courses link to `/jadwal/{course-slug}/`. Inactive archived courses omit that directory link because a schedule route is not generated for them.

Run `npm run build`, `npm run check` and `node scripts/verify-course-experience.mjs`. To compare SEO before a change, build the baseline and run the verification script with `--capture-baseline`, then rebuild and run it normally. Generated reports and screenshots are saved under `output/course-redesign/` and are not source files. The SEO audit is `npm run seo:audit`; distinguish existing issues from regressions.
