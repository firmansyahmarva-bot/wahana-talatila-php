# Article system

All article data stays in `data/articles/*.json`. Routes contain no page-specific design. `ArticlePage`, `ArticleArchive`, `ArticleCard`, `ArticleToc`, and `ArticlePagination` own the shared presentation. Shared actions and contact panel live in `src/components/shared`; colours use the existing CSS tokens.

## Publishing and relationships

Keep the existing title, slug, metadata, author, dates, content HTML and FAQ fields. New articles automatically enter the archive, search index and relationship index during the build. Publishing still follows the existing JSON collection workflow.

Optional fields:

```json
{
  "topic": "system-management",
  "topic_tags": ["smk3", "audit internal"],
  "related_article_slugs": ["5-prinsip-dasar-smk3"],
  "related_training_slugs": ["ak3-bnsp"]
}
```

`topic` accepts `k3`, `lingkungan`, `mining`, `system-management`. Without it, existing category/title information selects the topic. Tags improve relationship matching. Editorial overrides come first; invalid, inactive or duplicate targets and self-links are excluded.

Automatic links use title, keywords and tags, weighted toward uncommon terms. The build creates an inverted index, checks at most 500 article candidates per article and caches recommendations. Each page renders up to four related articles and two relevant active training courses as crawlable HTML links. It does not rewrite body links or insert keyword links into prose. Editors should review semantic relevance when adding specialist topics.

Archives render 24 articles per page with ordinary previous/next and numbered links. Additional pages have distinct self-canonicals. Existing archive URLs and metadata remain intact. Search fetches a metadata-only JSON index on first use, renders 24 results at a time and offers more results on request. All articles remain reachable through static archives without JavaScript. For substantially larger libraries, measure index download/search time and move search to a server index when necessary; search can change independently of the reader template.

## Contact and accessibility

The shared contact panel uses native details/summary, preserves the page-specific WhatsApp enquiry, supports Escape/outside-click closing and respects reduced motion. It opens on request. The mobile navigation remains shared. The reading template includes native FAQ disclosure, mobile contents disclosure, anchored headings and reading progress. Original body HTML is retained, with deterministic heading IDs added where missing.

## Verification

Run `npm run build`, `npm run check`, `node scripts/verify-article-experience.mjs` and `node scripts/verify-course-experience.mjs`. The article test needs a pre-change baseline in `output/course-redesign/seo-baseline.json` (captured with the course verifier's `--capture-baseline` against the previous build). Do not overwrite that baseline after changes. Browser tests require Playwright Chromium.

The initial migration preserved metadata, H1 text, schemas and all 168 article bodies across 1,591 existing HTML pages. SEO audit still reports 95 pre-existing mechanical issues (94 numeric schedule canonical issues and one redirect page with two H1s); they are outside this design change. Search rankings are not guaranteed by mechanical checks.
