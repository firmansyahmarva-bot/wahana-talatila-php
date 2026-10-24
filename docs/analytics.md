# Analytics integration

The existing production container is `GTM-MMZHD3HN`. Its published version 21 (inspected 24 October 2026) loads Google tag `G-CD5YR72WXR`, Microsoft Clarity, and a GA4 `whatsapp_click` tag triggered by native `gtm.linkClick` events whose URL contains `wa.me`.

## Shared installation

`AnalyticsHead.astro` loads the existing GTM container asynchronously in `BaseLayout`. It reads only the two public IDs from `analyticsConfig.ts`; the full settings JSON is never serialized to the browser. GTM remains responsible for Google tag configuration and the automatic page view. No second GA configuration or manual page-view event is added.

Production hosts `wahanatotalita.com` and `www.wahanatotalita.com` load tracking immediately. Local and staging hosts do not send production analytics by default. Add `?analytics_debug=1` to explicitly test those hosts and enable the documented GA debug-mode parameter. Remove it after testing. Browsers that block Google scripts cannot report events.

## Click events

The published GTM container continues to own `whatsapp_click`. The shared `analytics-leads.js` handler sends one `generate_lead` event for an actual WhatsApp link click, including page path, course slug, lead type, link domain and CTA position. It excludes generic navigation and buttons merely containing words such as “Daftar”. Capture-phase delegation also covers dynamically rendered schedule cards and keyboard activation. A registration/contact click represents an enquiry intent, not a confirmed enrolment.

The former implementation called `gtag` and pushed a second `generate_lead` object. The replacement has one dispatch path and an installation guard. It waits for the documented Google-tag `client_id` callback before flushing early clicks, so an event queued before tag configuration is not lost. It does not send WhatsApp enquiry text, phone numbers or arbitrary form values in custom parameters.

`whatsapp_click` and `generate_lead` are different events describing the same interaction; do not add their counts together as separate leads. The existing native GTM click listener requires GTM to have loaded, while the application lead queue covers early clicks. Do not add another WhatsApp-click tag without checking duplicate firing. GTM's existing tag does not map the custom lead-context parameters; those parameters are attached to `generate_lead`.

## Verification

Run `npm run build`, `npm run check`, and `node scripts/verify-analytics.mjs --download`. The last command caches the public GTM and Google-tag JavaScript as `.txt` audit fixtures, runs them in Playwright against the built pages, and intercepts all collection requests. It confirms the destination ID, one automatic page view, one native WhatsApp event, one contextual lead event, duplicate-install protection, local exclusion and an early click with delayed GTM. No test events reach the real GA property. Playwright Chromium must be installed.

For account-side acceptance after deployment: open GTM Preview for the deployed URL, follow one WhatsApp link, and inspect `whatsapp_click` and `generate_lead` in GA4 DebugView or Realtime event counts. The Realtime **pages** report shows page views, not click events. Browser request verification does not prove that property filters, consent settings or private report configuration accept/display an event. Public deployment must be checked separately from a successful Git push; the live catalogue was still the older PHP layout during this investigation.
