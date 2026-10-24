import {getArticleVisual} from './articleVisuals';

export const CATEGORY_TITLES: Record<string, { title: string; h1: string; desc: string }> = {
  k3: {
    title: 'Artikel & Panduan K3 Keselamatan Kerja | Wahana Totalita',
    h1: 'Artikel & Panduan K3',
    desc: 'Kumpulan artikel edukasi keselamatan dan kesehatan kerja (K3), regulasi Kemnaker RI, panduan SMK3, dan tips keselamatan industri.',
  },
  lingkungan: {
    title: 'Artikel K3 Lingkungan & Pengolahan Limbah | Wahana Totalita',
    h1: 'Artikel K3 Lingkungan & Limbah',
    desc: 'Panduan teknis pengelolaan limbah B3, pengendalian pencemaran air dan udara, serta sertifikasi kompetensi lingkungan BNSP.',
  },
  mining: {
    title: 'Artikel & Regulasi K3 Pertambangan (Minerba) | Wahana Totalita',
    h1: 'Artikel K3 Pertambangan (Minerba)',
    desc: 'Panduan keselamatan operasional pertambangan, regulasi Kepmen ESDM, dan kompetensi pengawas operasional POP, POM, POU.',
  },
  'system-management': {
    title: 'Panduan ISO & Sistem Manajemen SMK3 | Wahana Totalita',
    h1: 'Panduan ISO & Sistem Manajemen',
    desc: 'Panduan implementasi SMK3 PP 50/2012, audit SMK3 kriteria emas, ISO 45001, ISO 9001, dan integrasi sistem manajemen perusahaan.',
  },
};


/** Keep the existing article and category SEO identity independent of presentation. */
export function getArticleSeo(type: 'article' | 'category', data: any) {
let pageTitle = '';
let pageDesc = '';
let canonicalUrl = '';
let imageUrl = 'https://wahanatotalita.com/assets/img/og-cover.jpg';
let schemas: Record<string, any>[] = [];

if (type === 'category') {
  const seo = CATEGORY_TITLES[data.category.slug] || {
    title: `Artikel ${data.category.name} | Wahana Totalita`,
    h1: `Artikel ${data.category.name}`,
    desc: `Kumpulan artikel dan panduan ${data.category.name} dari Wahana Totalita Konsultan.`,
  };
  pageTitle = seo.title;
  pageDesc = seo.desc;
  canonicalUrl = `https://wahanatotalita.com/artikel/${data.category.slug}/`;
  schemas = [
    {
      '@context': 'https://schema.org',
      '@type': 'CollectionPage',
      name: seo.h1,
      description: seo.desc,
      url: canonicalUrl,
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Beranda', item: 'https://wahanatotalita.com/' },
        { '@type': 'ListItem', position: 2, name: 'Artikel', item: 'https://wahanatotalita.com/artikel/' },
        { '@type': 'ListItem', position: 3, name: data.category.name, item: canonicalUrl },
      ],
    },
  ];
} else {
  pageTitle = data.meta_title || `${data.title} — Wahana Totalita`;
  pageDesc = data.meta_desc || data.title;
  canonicalUrl = `https://wahanatotalita.com/artikel/${data.slug}/`;
  const visual = getArticleVisual(data.slug);
  imageUrl = visual ? `https://wahanatotalita.com${visual.src}` : data.thumbnail || 'https://wahanatotalita.com/assets/img/og-cover.jpg';

  schemas = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      mainEntityOfPage: {
        '@type': 'WebPage',
        '@id': canonicalUrl,
      },
      headline: data.title,
      description: pageDesc,
      image: imageUrl,
      author: {
        '@type': 'Person',
        name: data.author || 'PT Wahana Totalita Konsultan',
      },
      publisher: {
        '@type': 'Organization',
        name: 'PT Wahana Totalita Konsultan',
        logo: {
          '@type': 'ImageObject',
          url: 'https://wahanatotalita.com/assets/img/logo-wt.png',
        },
      },
      datePublished: data.published_at || '2026-01-01',
      dateModified: data.updated_at || data.published_at || '2026-01-01',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Beranda', item: 'https://wahanatotalita.com/' },
        { '@type': 'ListItem', position: 2, name: 'Artikel', item: 'https://wahanatotalita.com/artikel/' },
        { '@type': 'ListItem', position: 3, name: data.category || 'K3', item: `https://wahanatotalita.com/artikel/` },
        { '@type': 'ListItem', position: 4, name: data.title, item: canonicalUrl },
      ],
    },
  ];

  if (Array.isArray(data.faq_list) && data.faq_list.length > 0) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: data.faq_list.map((item: any) => ({
        '@type': 'Question',
        name: item.q || item.question,
        acceptedAnswer: {
          '@type': 'Answer',
          text: item.a || item.answer,
        },
      })),
    });
  }
}

return {title:pageTitle, description:pageDesc, canonical:canonicalUrl, ogImage:imageUrl, schemas};
}
