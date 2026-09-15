# Content Style

Applies to all Markdown page content and blueprint-generated copy, for every subdomain.

- Plain, direct, no filler. No "In today's fast-paced world..." openers.
- Every page answers a real search intent stated in its frontmatter/blueprint entry.
- Headings are descriptive, not clever — they carry the keyword the page targets.
- FAQ answers are self-contained: a reader skimming only the answer gets the point.
- No keyword stuffing — one primary keyword per page, supporting keywords used
  naturally, never forced into every paragraph.
- Markdown frontmatter schema for long-form pages:
  ```yaml
  ---
  title:
  slug:
  type: pillar | cluster | page
  primary_keyword:
  supporting_keywords: []
  search_intent:
  ---
  ```
