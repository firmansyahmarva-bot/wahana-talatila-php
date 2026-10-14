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

export const collections = {
  articles,
  trainings,
  programmaticTrainings,
  categories,
  cities,
  glossary,
  trainingBatches,
  hubs,
};

