/**
 * Helper to auto-generate upcoming batch dates for any training program.
 * Rules come from src/data/jadwal-config.json.
 * Every program always returns at least 3-4 upcoming dates from today onward.
 */
import config from '../data/jadwal-config.json';
import trainingsRaw from '../../data/trainings.json';
import batchesRaw from '../../data/training_batches.json';

export interface BatchItem {
  id: string | number;
  batch_name: string;
  start_date: string; // YYYY-MM-DD
  end_date: string;   // YYYY-MM-DD
  mode: string;       // 'online' | 'offline' | 'hybrid' | 'both'
  venue: string;
  price: number;
  is_generated?: boolean;
}

const MONTHS_INDO = [
  'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

export function formatDateIndo(dateStr?: string | null): string {
  if (!dateStr || dateStr === '0000-00-00') return '';
  const parts = dateStr.split('-');
  if (parts.length === 3) {
    const year = parts[0];
    const month = parseInt(parts[1], 10) - 1;
    const day = parseInt(parts[2], 10);
    if (!isNaN(month) && month >= 0 && month < 12 && !isNaN(day)) {
      return `${day} ${MONTHS_INDO[month]} ${year}`;
    }
  }
  const d = new Date(dateStr + 'T00:00:00');
  if (isNaN(d.getTime())) return dateStr;
  return `${d.getDate()} ${MONTHS_INDO[d.getMonth()]} ${d.getFullYear()}`;
}

export function formatBatchRange(startDate: string, endDate?: string | null): string {
  if (!startDate) return '';
  if (!endDate || endDate === startDate) return formatDateIndo(startDate);
  
  const startParts = startDate.split('-');
  const endParts = endDate.split('-');
  if (startParts.length === 3 && endParts.length === 3) {
    const sYear = startParts[0];
    const sMonth = parseInt(startParts[1], 10) - 1;
    const sDay = parseInt(startParts[2], 10);
    const eYear = endParts[0];
    const eMonth = parseInt(endParts[1], 10) - 1;
    const eDay = parseInt(endParts[2], 10);

    if (sYear === eYear && sMonth === eMonth) {
      return `${sDay} - ${eDay} ${MONTHS_INDO[eMonth]} ${eYear}`;
    }
  }
  return `${formatDateIndo(startDate)} - ${formatDateIndo(endDate)}`;
}

// Find nth occurrence of dayOfWeek in a month (1-indexed nth)
function getNthDayOfMonth(year: number, month: number, dayOfWeek: number, nth: number): Date {
  const firstDay = new Date(year, month, 1);
  let dayOffset = dayOfWeek - firstDay.getDay();
  if (dayOffset < 0) dayOffset += 7;
  const firstOccurrenceDate = 1 + dayOffset;
  const targetDate = firstOccurrenceDate + (nth - 1) * 7;
  return new Date(year, month, targetDate);
}

function formatDateISO(d: Date): string {
  const y = d.getFullYear();
  const m = String(d.getMonth() + 1).padStart(2, '0');
  const day = String(d.getDate()).padStart(2, '0');
  return `${y}-${m}-${day}`;
}

function addDays(d: Date, days: number): Date {
  const res = new Date(d);
  res.setDate(res.getDate() + days);
  return res;
}

/**
 * Returns the next 3-4 batches for a program, from today onward.
 * Combines existing real future batches (if any) with auto-generated batches.
 * Guarantees at least 4 batches returned.
 */
export function getUpcomingBatches(
  programSlug: string,
  citySlug?: string,
  limit: number = 4
): BatchItem[] {
  const todayStr = new Intl.DateTimeFormat('en-CA', { timeZone: 'Asia/Jakarta' }).format(new Date());
  
  // 1. Find training metadata
  const training = (trainingsRaw as any[]).find((t) => t.slug === programSlug);
  const trainingName = training?.name || programSlug;
  const trainingPrice = training?.price || 0;
  const durationDays = training?.duration_days || 3;

  // 2. City override if citySlug passed
  const cityOverrides = (config as any).cityOverrides || {};
  const cityOverride = citySlug ? cityOverrides[citySlug.toLowerCase()] : null;
  const cityName = citySlug ? citySlug.charAt(0).toUpperCase() + citySlug.slice(1) : '';

  // 3. Find rule for this program
  const progRule = (config as any).programs?.[programSlug] || (config as any).default;
  const mode = cityOverride?.mode || progRule.mode || training?.mode || 'online';
  const defaultVenue = mode === 'online' 
    ? 'Online via Zoom' 
    : (cityOverride?.venue || (cityName ? `Training Center ${cityName}` : 'Training Center Yogyakarta'));

  // 4. Check existing future batches from data/training_batches.json
  const existingMatches: BatchItem[] = [];
  if (training && training.id) {
    const realBatches = (batchesRaw as any[])
      .filter((b) => 
        (b.course_id === training.id || String(b.course_id) === String(training.id)) &&
        b.is_public !== 0 &&
        b.start_date &&
        b.start_date >= todayStr
      )
      .sort((a, b) => a.start_date.localeCompare(b.start_date));

    for (const b of realBatches) {
      existingMatches.push({
        id: b.id,
        batch_name: b.batch_name || `${trainingName} - Batch ${formatDateIndo(b.start_date)}`,
        start_date: b.start_date,
        end_date: b.end_date || b.start_date,
        mode: b.mode || mode,
        venue: b.venue || defaultVenue,
        price: b.price || trainingPrice,
        is_generated: false,
      });
    }
  }

  // If we already have enough real batches, return them
  if (existingMatches.length >= limit) {
    return existingMatches.slice(0, limit);
  }

  // 5. Generate future dates starting from current month
  const generated: BatchItem[] = [];
  const now = new Date();
  let currentYear = now.getFullYear();
  let currentMonth = now.getMonth();

  // Search through next 6 months to collect enough future dates
  for (let m = 0; m < 6 && (existingMatches.length + generated.length) < limit; m++) {
    const iterMonth = (currentMonth + m) % 12;
    const iterYear = currentYear + Math.floor((currentMonth + m) / 12);

    let datesToTry: Date[] = [];

    if (progRule.rule === 'weekly_monday') {
      // 1st, 2nd, 3rd, 4th Monday
      for (let nth = 1; nth <= 4; nth++) {
        datesToTry.push(getNthDayOfMonth(iterYear, iterMonth, progRule.dayOfWeek ?? 1, nth));
      }
    } else if (progRule.rule === 'monthly') {
      // 2nd Monday or week from config
      const nth = progRule.weeks?.[0] || 2;
      datesToTry.push(getNthDayOfMonth(iterYear, iterMonth, progRule.dayOfWeek ?? 1, nth));
    } else {
      // Default: 2_per_month (1st & 3rd week)
      const weeks = progRule.weeks || [1, 3];
      for (const w of weeks) {
        datesToTry.push(getNthDayOfMonth(iterYear, iterMonth, progRule.dayOfWeek ?? 1, w));
      }
    }

    for (const startDate of datesToTry) {
      const startStr = formatDateISO(startDate);
      // Only take future dates
      if (startStr >= todayStr) {
        // Avoid duplicate dates if a real batch already exists on that date
        const alreadyExists = existingMatches.some((b) => b.start_date === startStr) ||
                              generated.some((b) => b.start_date === startStr);
        if (!alreadyExists) {
          const endDate = addDays(startDate, Math.max(0, durationDays - 1));
          const endStr = formatDateISO(endDate);
          generated.push({
            id: `gen-${programSlug}-${startStr}`,
            batch_name: `${trainingName} - Batch ${formatDateIndo(startStr)}`,
            start_date: startStr,
            end_date: endStr,
            mode,
            venue: defaultVenue,
            price: trainingPrice,
            is_generated: true,
          });
          if (existingMatches.length + generated.length >= limit) break;
        }
      }
    }
  }

  // Combine real and generated, sort by start_date ascending
  const allBatches = [...existingMatches, ...generated]
    .sort((a, b) => a.start_date.localeCompare(b.start_date))
    .slice(0, limit);

  return allBatches;
}
