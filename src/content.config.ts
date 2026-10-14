import { defineCollection } from 'astro:content';
import { z } from 'astro/zod';
import { glob, file } from 'astro/loaders';

/**
 * 1. Articles Collection
 * 168 complete & sanitized educational and regulatory articles.
 */
const articles = defineCollection({
  loader: glob({ pattern: '**/*.json', base: './data/articles' }),
  schema: z.object({
    id: z.number(),
    title: z.string(),
    slug: z.string(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    keywords: z.string().optional().nullable(),
    category: z.string().optional().nullable(),
    thumbnail: z.string().optional().nullable(),
    content: z.string().optional().nullable(),
    faq_data: z.string().optional().nullable(),
    faq_list: z.any().optional().nullable(),
    author: z.string().optional().nullable(),
    status: z.string().optional().nullable(),
    published_at: z.string().optional().nullable(),
    view_count: z.number().optional().nullable(),
    created_at: z.string().optional().nullable(),
    updated_at: z.string().optional().nullable(),
  }),
});

/**
 * 2. Trainings Collection
 * 148 certified courses and competency programs.
 */
const trainings = defineCollection({
  loader: glob({ pattern: '**/*.json', base: './data/trainings' }),
  schema: z.object({
    id: z.number(),
    category_id: z.number().optional().nullable(),
    category_name: z.string().optional().nullable(),
    category_slug: z.string().optional().nullable(),
    name: z.string(),
    slug: z.string(),
    mode: z.string().optional().nullable(),
    certification: z.string().optional().nullable(),
    price: z.union([z.number(), z.string()]).optional().nullable(),
    price_label: z.string().optional().nullable(),
    description: z.string().optional().nullable(),
    long_content: z.string().optional().nullable(),
    curriculum: z.string().optional().nullable(),
    curriculum_data: z.any().optional().nullable(),
    duration_days: z.union([z.number(), z.string()]).optional().nullable(),
    image_path: z.string().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    wa_text: z.string().optional().nullable(),
    is_featured: z.union([z.number(), z.boolean()]).optional().nullable(),
    is_active: z.union([z.number(), z.boolean()]).optional().nullable(),
    view_count: z.number().optional().nullable(),
    sort_order: z.number().optional().nullable(),
    validity_months: z.union([z.number(), z.string()]).optional().nullable(),
    created_at: z.string().optional().nullable(),
    updated_at: z.string().optional().nullable(),
  }),
});

/**
 * 3. Pelatihan Data (Programmatic Course Pages)
 * 352 high-value programmatic landing pages across Indonesian industrial hubs.
 */
const programmaticTrainings = defineCollection({
  loader: glob({ pattern: '**/*.json', base: './pelatihan-data' }),
  schema: z.object({
    slug: z.string(),
    title: z.string(),
    description: z.string().optional().nullable(),
    canonical: z.string().optional().nullable(),
    content: z.string().optional().nullable(),
    schemas: z.any().optional().nullable(),
  }),
});

/**
 * 4. Categories Collection
 */
const categories = defineCollection({
  loader: file('./data/categories.json'),
  schema: z.object({
    id: z.number(),
    name: z.string(),
    slug: z.string(),
    icon: z.string().optional().nullable(),
    description: z.string().optional().nullable(),
    accent_color: z.string().optional().nullable(),
    sort_order: z.number().optional().nullable(),
    is_active: z.union([z.number(), z.boolean()]).optional().nullable(),
    created_at: z.string().optional().nullable(),
    updated_at: z.string().optional().nullable(),
  }),
});

/**
 * 5. Cities Collection
 */
const cities = defineCollection({
  loader: file('./data/cities.json'),
  schema: z.object({
    id: z.number(),
    name: z.string(),
    slug: z.string(),
    province: z.string().optional().nullable(),
    province_slug: z.string().optional().nullable(),
    population: z.union([z.number(), z.string()]).optional().nullable(),
    industry_type: z.string().optional().nullable(),
    price_modifier: z.union([z.number(), z.string()]).optional().nullable(),
  }),
});

/**
 * 6. Glossary Collection
 */
const glossary = defineCollection({
  loader: file('./data/glossary.json'),
  schema: z.object({
    id: z.number(),
    term: z.string(),
    slug: z.string(),
    category: z.string().optional().nullable(),
    definition: z.string().optional().nullable(),
    full_article: z.string().optional().nullable(),
    regulation: z.string().optional().nullable(),
    related_terms: z.any().optional().nullable(),
    related_training_id: z.union([z.number(), z.string()]).optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    view_count: z.number().optional().nullable(),
    is_active: z.union([z.number(), z.boolean()]).optional().nullable(),
    created_at: z.string().optional().nullable(),
  }),
});

/**
 * 7. Training Batches Collection
 */
const trainingBatches = defineCollection({
  loader: file('./data/training_batches.json'),
  schema: z.object({
    id: z.number(),
    course_id: z.union([z.number(), z.string()]).optional().nullable(),
    instructor_id: z.union([z.number(), z.string()]).optional().nullable(),
    batch_name: z.string().optional().nullable(),
    start_date: z.string().optional().nullable(),
    end_date: z.string().optional().nullable(),
    mode: z.string().optional().nullable(),
    venue: z.string().optional().nullable(),
    max_participants: z.union([z.number(), z.string()]).optional().nullable(),
    status: z.string().optional().nullable(),
    notes: z.string().optional().nullable(),
    created_by: z.union([z.number(), z.string()]).optional().nullable(),
    created_at: z.string().optional().nullable(),
    updated_at: z.string().optional().nullable(),
    price: z.union([z.number(), z.string()]).optional().nullable(),
    price_notes: z.string().optional().nullable(),
    is_public: z.union([z.number(), z.boolean()]).optional().nullable(),
  }),
});

/**
 * 8. Sector Hubs Collection (24 Industrial Hubs)
 */
const hubs = defineCollection({
  loader: file('./data/hubs.json'),
  schema: z.object({
    id: z.string(),
    slug: z.string(),
    badge: z.string().optional().nullable(),
    title: z.string(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    intro_lead: z.string().optional().nullable(),
    intro: z.union([z.array(z.string()), z.string()]).optional().nullable(),
    regulasi: z.array(z.object({
      nomor: z.string(),
      desc: z.string(),
    })).optional().nullable(),
    comparison: z.any().optional().nullable(),
    programs: z.array(z.object({
      slug: z.string(),
      name: z.string(),
      cert: z.string().optional().nullable(),
      mode: z.string().optional().nullable(),
      duration: z.string().optional().nullable(),
      desc: z.string().optional().nullable(),
      target_peserta: z.string().optional().nullable(),
      wa_text: z.string().optional().nullable(),
    })).optional().nullable(),
    syarat: z.array(z.string()).optional().nullable(),
    materi: z.array(z.string()).optional().nullable(),
    faqs: z.array(z.object({
      q: z.string(),
      a: z.string(),
    })).optional().nullable(),
    related_hubs: z.array(z.object({
      slug: z.string(),
      name: z.string(),
      badge: z.string().optional().nullable(),
      desc: z.string().optional().nullable(),
    })).optional().nullable(),
  }),
});

/**
 * 9. Incidents Collection (Database Kecelakaan Kerja Indonesia)
 */
const incidents = defineCollection({
  loader: file('./data/incidents.json'),
  schema: z.object({
    id: z.number(),
    title: z.string(),
    slug: z.string(),
    company: z.string().optional().nullable(),
    province: z.string().optional().nullable(),
    city: z.string().optional().nullable(),
    industry: z.string().optional().nullable(),
    incident_type: z.string().optional().nullable(),
    incident_date: z.string().optional().nullable(),
    deaths: z.number().optional().nullable(),
    injured: z.number().optional().nullable(),
    description: z.string().optional().nullable(),
    root_cause: z.string().optional().nullable(),
    regulation_violated: z.string().optional().nullable(),
    prevention: z.string().optional().nullable(),
    source_url: z.string().optional().nullable(),
    source_name: z.string().optional().nullable(),
    is_verified: z.union([z.number(), z.boolean()]).optional().nullable(),
    is_active: z.union([z.number(), z.boolean()]).optional().nullable(),
    view_count: z.number().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    created_at: z.string().optional().nullable(),
    updated_at: z.string().optional().nullable(),
  }),
});

/**
 * 10. Perpanjangan SKP & Lisensi Collection (17 Renewal Services)
 */
const perpanjanganSkp = defineCollection({
  loader: file('./data/perpanjangan_skp.json'),
  schema: z.object({
    id: z.string(),
    slug: z.string(),
    judul: z.string(),
    kategori: z.string().optional().nullable(),
    kategori_label: z.string().optional().nullable(),
    dasar_hukum: z.string().optional().nullable(),
    tagline: z.string().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    keywords: z.array(z.string()).optional().nullable(),
    masa_berlaku: z.string().optional().nullable(),
    biaya_standar: z.string().optional().nullable(),
    biaya_batch: z.string().optional().nullable(),
    durasi_proses: z.string().optional().nullable(),
    city_keyword: z.string().optional().nullable(),
    deskripsi_lengkap: z.string().optional().nullable(),
    syarat_dokumen: z.array(z.string()).optional().nullable(),
    alur_proses: z.array(z.string()).optional().nullable(),
    faqs: z.array(z.object({
      q: z.string(),
      a: z.string(),
    })).optional().nullable(),
  }),
});

/**
 * 11. Event Organizer Collection (24 Corporate, Government MICE & HSE Events)
 */
const eventOrganizer = defineCollection({
  loader: file('./data/event_organizer.json'),
  schema: z.object({
    id: z.string(),
    slug: z.string(),
    judul: z.string(),
    kategori: z.string().optional().nullable(),
    kategori_label: z.string().optional().nullable(),
    tagline: z.string().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    keywords: z.array(z.string()).optional().nullable(),
    target_klien: z.string().optional().nullable(),
    durasi_event: z.string().optional().nullable(),
    lokasi_layanan: z.string().optional().nullable(),
    biaya_standar: z.string().optional().nullable(),
    biaya_batch: z.string().optional().nullable(),
    b2b_min_peserta: z.string().optional().nullable(),
    inaproc_relevance: z.string().optional().nullable(),
    city_mentions: z.array(z.string()).optional().nullable(),
    companies_mentions: z.array(z.string()).optional().nullable(),
    highlight_pillars: z.array(z.string()).optional().nullable(),
    deskripsi_lengkap: z.string().optional().nullable(),
    spesifikasi_teknis: z.array(z.object({
      item: z.string(),
      spek: z.string(),
    })).optional().nullable(),
    susunan_acara: z.array(z.object({
      fase: z.string(),
      agenda: z.string(),
    })).optional().nullable(),
    deliverables_output: z.array(z.string()).optional().nullable(),
    faqs: z.array(z.object({
      q: z.string(),
      a: z.string(),
    })).optional().nullable(),
  }),
});

/**
 * 12. Purnabakti / MPP Collection (7 Preparation for Retirement Programs)
 */
const purnabakti = defineCollection({
  loader: file('./data/purnabakti.json'),
  schema: z.object({
    id: z.string(),
    slug: z.string(),
    judul: z.string(),
    kategori: z.string().optional().nullable(),
    kategori_label: z.string().optional().nullable(),
    tagline: z.string().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    keywords: z.array(z.string()).optional().nullable(),
    target_peserta: z.string().optional().nullable(),
    durasi_program: z.string().optional().nullable(),
    lokasi_utama: z.string().optional().nullable(),
    biaya_standar: z.string().optional().nullable(),
    biaya_batch: z.string().optional().nullable(),
    b2b_min_batch: z.string().optional().nullable(),
    city_mentions: z.array(z.string()).optional().nullable(),
    companies_mentions: z.array(z.string()).optional().nullable(),
    highlight_pillars: z.array(z.string()).optional().nullable(),
    deskripsi_lengkap: z.string().optional().nullable(),
    silabus_modul: z.array(z.object({
      modul: z.string(),
      durasi: z.string().optional().nullable(),
      fokus: z.string().optional().nullable(),
      output: z.string().optional().nullable(),
    })).optional().nullable(),
    jadwal_rundown: z.record(z.string()).optional().nullable(),
    kunjungan_lapangan: z.array(z.string()).optional().nullable(),
    fasilitas_include: z.array(z.string()).optional().nullable(),
    faqs: z.array(z.object({
      q: z.string(),
      a: z.string(),
    })).optional().nullable(),
  }),
});

/**
 * 13. Riksa Uji K3 Collection (8 Statutory Inspection Services)
 */
const riksaUji = defineCollection({
  loader: file('./data/riksa_uji.json'),
  schema: z.object({
    id: z.string(),
    slug: z.string(),
    judul: z.string(),
    kategori: z.string().optional().nullable(),
    kategori_label: z.string().optional().nullable(),
    dasar_hukum: z.string().optional().nullable(),
    tagline: z.string().optional().nullable(),
    meta_title: z.string().optional().nullable(),
    meta_desc: z.string().optional().nullable(),
    keywords: z.array(z.string()).optional().nullable(),
    masa_berlaku: z.string().optional().nullable(),
    lingkup_alat: z.string().optional().nullable(),
    tahapan_uji: z.array(z.string()).optional().nullable(),
    dokumen_syarat: z.array(z.string()).optional().nullable(),
    regional_insight: z.string().optional().nullable(),
    pelatihan_terkait: z.object({
      slug: z.string(),
      name: z.string(),
    }).optional().nullable(),
    faqs: z.array(z.object({
      q: z.string(),
      a: z.string(),
    })).optional().nullable(),
  }),
});

export const collections = {
  articles,
  trainings,
  programmaticTrainings,
  categories,
  cities,
  glossary,
  trainingBatches,
  hubs,
  incidents,
  perpanjanganSkp,
  eventOrganizer,
  purnabakti,
  riksaUji,
};


