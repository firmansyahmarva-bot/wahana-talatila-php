import type { CollectionEntry } from 'astro:content';

export type TrainingRecord = CollectionEntry<'trainings'>['data'];

// Same JSON records used by Astro's `trainings` collection. The aggregate export
// is retained for compatibility outside Astro, but is not a second site source.
const records = import.meta.glob<TrainingRecord>('../../data/trainings/*.json', {
  eager: true,
  import: 'default',
});
export const trainingCatalog = Object.values(records).sort((a, b) => a.id - b.id);

export function getCourseCurriculum(training: Pick<TrainingRecord, 'curriculum_data' | 'curriculum'>): string[] {
  if (Array.isArray(training.curriculum_data) && training.curriculum_data.length) return training.curriculum_data;
  try {
    const value = typeof training.curriculum === 'string' ? JSON.parse(training.curriculum) : training.curriculum;
    return Array.isArray(value) ? value : [];
  } catch {
    return [];
  }
}
