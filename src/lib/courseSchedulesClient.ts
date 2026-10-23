/** Enhance server-rendered schedules when the existing live feed is available. */
interface LiveSchedule { start_date: string; end_date?: string; mode?: string; location?: string; price?: number }
export async function enhanceCourseSchedules() {
  const grid = document.querySelector<HTMLElement>('.ce-schedule-grid');
  if (!grid) return;
  let slug = document.body.dataset.trainingSlug || '';
  if (!slug) return;
  let city = document.body.dataset.city || '';
  const cities = ['balikpapan', 'bandung', 'bantul', 'batam', 'bekasi', 'cilegon', 'jakarta', 'makassar', 'malang', 'medan', 'pekanbaru', 'semarang', 'sleman', 'solo', 'surabaya', 'yogyakarta'];
  if (!city) {
    const suffix = cities.find(value => slug.endsWith('-' + value));
    if (suffix) { city = suffix[0].toUpperCase() + suffix.slice(1); slug = slug.slice(0, -suffix.length - 1); }
  }
  try {
    const response = await fetch('/api/public-schedules.php?' + new URLSearchParams({ training_slug: slug, city }), { headers: { Accept: 'application/json' } });
    if (!response.ok) return;
    const result = await response.json();
    if (!result?.success || !Array.isArray(result.schedules)) return;
    const rows: LiveSchedule[] = result.schedules.filter((row: LiveSchedule) => row && /^\d{4}-\d{2}-\d{2}$/.test(row.start_date)).slice(0, 4);
    if (!rows.length || grid.contains(document.activeElement)) return;
    const dateFormat = new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    const formatDate = (value: string) => dateFormat.format(new Date(value + 'T00:00:00'));
    const money = (value: number) => value > 0 ? 'Rp ' + value.toLocaleString('id-ID') : 'Hubungi Kami';
    const make = (tag: string, className: string, text: string) => { const node = document.createElement(tag); node.className = className; node.textContent = text; return node; };
    const cards = rows.map((row, index) => {
      const range = formatDate(row.start_date) + (row.end_date && row.end_date !== row.start_date && /^\d{4}-\d{2}-\d{2}$/.test(row.end_date) ? ' – ' + formatDate(row.end_date) : '');
      const card = make('article', 'ce-schedule-card' + (index === 0 ? ' ce-schedule-first' : ''), '');
      card.append(make('span', 'ce-schedule-label', index === 0 ? 'Batch terdekat' : 'Pilihan batch'), make('h3', '', range), make('p', '', row.mode === 'online' ? 'Online via Zoom' : row.location || city || 'Konfirmasi lokasi pelatihan'));
      const footer = make('div', 'ce-schedule-footer', '');
      const link = document.createElement('a');
      const message = `Halo Wahana Totalita, saya ingin mendaftar ${grid.dataset.courseName}, batch ${range}. Mohon konfirmasi ketersediaan kelas, biaya, dan persyaratan.`;
      link.href = 'https://wa.me/6287759151278?text=' + encodeURIComponent(message);
      link.target = '_blank';
      link.rel = 'noopener noreferrer';
      link.textContent = 'Daftar WhatsApp →';
      link.setAttribute('aria-label', `Daftar ${grid.dataset.courseName} batch ${range}`);
      footer.append(make('strong', '', money(Number(row.price) > 0 ? Number(row.price) : Number(grid.dataset.coursePrice))), link);
      card.append(footer);
      return card;
    });
    grid.replaceChildren(...cards);
    const nextDate = document.querySelector('[data-course-next-date]');
    const firstDate = cards[0]?.querySelector('h3')?.textContent;
    if (nextDate && firstDate) nextDate.textContent = firstDate;
  } catch {
    // The complete server-rendered schedule stays usable when the feed is unavailable.
  }
}
