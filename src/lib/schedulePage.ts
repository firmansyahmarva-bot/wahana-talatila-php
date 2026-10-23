import jadwalPosters from './jadwal-posters.json';
import { getCourseCurriculum, type TrainingRecord } from './trainingCatalog';
import { getUpcomingBatches, formatDateIndo, formatBatchRange, formatIsoWithTz } from './jadwal';

export interface SchedulePageProps {
  pageType: 'program' | 'batch';
  batch: any;
  training: TrainingRecord | null;
  slug: string | null;
}

/** Schedule SEO is independent of the shared visual components. */
export function getSchedulePage({pageType, batch, training, slug}: SchedulePageProps) {
  const isProgramPage = pageType === 'program';

  const trainingName = training?.name || batch?.batch_name || 'Pelatihan K3';
  const trainingSlug = training?.slug || slug || '';
  const schedulePoster = isProgramPage
    ? (jadwalPosters as Record<string, { image: string; image1200: string; image640: string; ogImage: string; alt: string }>)[trainingSlug]
    : undefined;
  const certification = training?.certification || 'Kemnaker RI / BNSP';
  const durationDays = training?.duration_days || 3;
  const price = (batch?.price && batch.price > 0) ? batch.price : (training?.price || 0);
  const mode = (batch?.mode || training?.mode || 'online').toLowerCase();
  const venue = batch?.venue || (mode === 'online' ? 'Online via Zoom Interaktif' : 'Training Center Wahana Totalita Yogyakarta');

  // Generate 3-4 upcoming dates for this program
  const upcomingBatches = getUpcomingBatches(trainingSlug, undefined, 4);
  const firstBatch = upcomingBatches[0];

  // Date strings
  const singleBatchDateStr = batch ? formatDateIndo(batch.start_date) : '';
  const singleBatchEndDateStr = batch?.end_date && batch.end_date !== batch.start_date ? formatDateIndo(batch.end_date) : '';

  // Titles & meta
  let pageTitle: string;
  let pageDesc: string;
  let canonical: string;

  if (isProgramPage) {
    // Requirement: Short unique title (under 60 chars) and meta description (under 155 chars)
    const shortName = trainingName.length > 40 ? trainingName.slice(0, 38).trimEnd() + '…' : trainingName;
    pageTitle = `Jadwal ${shortName} — Wahana Totalita`;
    if (pageTitle.length > 60) {
      pageTitle = `Jadwal ${trainingName.slice(0, 32)}… — Wahana`;
    }
    pageDesc = `Jadwal resmi pelatihan ${trainingName} sertifikasi ${certification}. Pilihan kelas Online & Tatap Muka. Cek tanggal batch & daftar langsung.`;
    if (pageDesc.length > 155) {
      pageDesc = pageDesc.slice(0, 152) + '…';
    }
    canonical = `https://wahanatotalita.com/jadwal/${trainingSlug}/`;
  } else {
    pageTitle = `Jadwal ${trainingName} (${singleBatchDateStr}) — Wahana Totalita`;
    pageDesc = `Jadwal resmi pelatihan ${trainingName} tanggal ${singleBatchDateStr} (${mode.toUpperCase()}). Sertifikasi ${certification}. Kurikulum resmi & pendaftaran.`;
    // Canonical consolidates numeric batch pages to the authoritative program schedule hub
    canonical = trainingSlug
      ? `https://wahanatotalita.com/jadwal/${trainingSlug}/`
      : `https://wahanatotalita.com/jadwal/${batch.id}/`;
  }

  // WhatsApp inquiry message
  const waMsg = isProgramPage
    ? `Halo Wahana Totalita, saya ingin mendaftar pelatihan:\n*${trainingName}*\nMohon informasi jadwal terdekat (${firstBatch ? formatBatchRange(firstBatch.start_date, firstBatch.end_date) : 'Batch Terdekat'}) dan invoice pendaftaran.`
    : `Halo Wahana Totalita, saya ingin mendaftar jadwal pelatihan:\n*${trainingName}*\nTanggal: ${singleBatchDateStr}\nMode: ${mode.toUpperCase()}\nURL batch: https://wahanatotalita.com/jadwal/${batch.id}/`;

  // Event JSON-LD Schemas
  const eventSchemas = isProgramPage
    ? upcomingBatches.map((b) => {
        const bMode = (b.mode || 'online').toLowerCase();
        return {
          '@context': 'https://schema.org',
          '@type': 'EducationalEvent',
          name: `Jadwal Pelatihan ${trainingName} - Batch ${formatDateIndo(b.start_date)}`,
          description: pageDesc,
          startDate: formatIsoWithTz(b.start_date, '08:00:00'),
          endDate: formatIsoWithTz(b.end_date || b.start_date, '17:00:00'),
          eventAttendanceMode: bMode === 'online'
            ? 'https://schema.org/OnlineEventAttendanceMode'
            : 'https://schema.org/OfflineEventAttendanceMode',
          eventStatus: 'https://schema.org/EventScheduled',
          url: canonical,
          organizer: {
            '@type': 'Organization',
            name: 'PT Wahana Totalita Konsultan',
            url: 'https://wahanatotalita.com',
          },
          location: bMode === 'online'
            ? { '@type': 'VirtualLocation', url: canonical }
            : {
                '@type': 'Place',
                name: b.venue || 'Training Center Wahana Totalita',
                address: {
                  '@type': 'PostalAddress',
                  addressLocality: 'Yogyakarta',
                  addressRegion: 'DI Yogyakarta',
                  addressCountry: 'ID',
                },
              },
          offers: {
            '@type': 'Offer',
            price: String(b.price || price || 0),
            priceCurrency: 'IDR',
            availability: 'https://schema.org/InStock',
            url: canonical,
          },
        };
      })
    : [
        {
          '@context': 'https://schema.org',
          '@type': 'EducationalEvent',
          name: `Jadwal Pelatihan ${trainingName} (${singleBatchDateStr})`,
          description: pageDesc,
          startDate: formatIsoWithTz(batch.start_date, '08:00:00'),
          endDate: formatIsoWithTz(batch.end_date && batch.end_date !== '0000-00-00' ? batch.end_date : batch.start_date, '17:00:00'),
          eventAttendanceMode: mode === 'online'
            ? 'https://schema.org/OnlineEventAttendanceMode'
            : 'https://schema.org/OfflineEventAttendanceMode',
          eventStatus: 'https://schema.org/EventScheduled',
          url: canonical,
          organizer: {
            '@type': 'Organization',
            name: 'PT Wahana Totalita Konsultan',
            url: 'https://wahanatotalita.com',
          },
          location: mode === 'online'
            ? { '@type': 'VirtualLocation', url: canonical }
            : {
                '@type': 'Place',
                name: venue,
                address: {
                  '@type': 'PostalAddress',
                  addressLocality: 'Yogyakarta',
                  addressRegion: 'DI Yogyakarta',
                  addressCountry: 'ID',
                },
              },
          offers: {
            '@type': 'Offer',
            price: String(price),
            priceCurrency: 'IDR',
            availability: 'https://schema.org/InStock',
            url: canonical,
          },
        },
      ];

  const curriculumList = getCourseCurriculum(training || {});

  // Format "Last updated" date in Indonesian
  const todayDate = new Date();
  const lastUpdatedStr = `${todayDate.getDate()} ${['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][todayDate.getMonth()]} ${todayDate.getFullYear()}`;
  return { isProgramPage, trainingName, trainingSlug, schedulePoster, certification, durationDays, price, mode, venue, upcomingBatches, firstBatch, singleBatchDateStr, singleBatchEndDateStr, pageTitle, pageDesc, canonical, waMsg, eventSchemas, curriculumList, lastUpdatedStr };
}
