import coursePosters from './course-posters.json';

const posters: Record<string, { image: string; image1200: string; image640: string; ogImage: string; alt: string }> = coursePosters;

/**
 * Image resolver for trainings and catalog cards.
 * Mirrors the PHP config.php training_img_url logic with 100% reliable local fallbacks.
 */

const GALLERY_THUMBS = [
  "11.jpeg","17.jpeg","21.jpeg","DSCN1494.JPG","DSC_0001.JPG","DSC_0002.JPG",
  "DSC_0003.JPG","DSC_0005.JPG","DSC_0006.JPG","DSC_0007.JPG","DSC_0008.JPG",
  "DSC_0009.JPG","DSC_0010.JPG","DSC_0011.JPG","DSC_0014.JPG","DSC_0016.JPG",
  "DSC_0019.JPG","DSC_0022.JPG","DSC_0025 (2).JPG","DSC_0029.JPG","DSC_0031.JPG",
  "DSC_0033.JPG","DSC_0034.JPG","DSC_0038.JPG","DSC_0039.JPG","DSC_0040.JPG",
  "DSC_0049.JPG","DSC_0057.JPG","DSC_0058.JPG","DSC_0061.JPG","DSC_0068.JPG",
  "DSC_0072.JPG","DSC_0074.JPG","DSC_0078.JPG","DSC_0082.JPG","DSC_0100.JPG",
  "DSC_0121.JPG","DSC_0142.JPG","DSC_0157.JPG","DSC_0159.JPG","DSC_0166.JPG",
  "DSC_0171.JPG","DSC_0179.JPG","DSC_0196.JPG","DSC_0200.JPG","DSC_0282.JPG",
  "FILE0134.PNG","FILE0161.PNG","FILE0162.PNG","FILE0171.PNG","FILE0311.PNG",
  "FILE0388.PNG","FOTO BARENG ada ibu sopian nor.jpg","FOTOBARENGadaibusopiannor.jpg",
  "IMG20180427152903.jpg","IMG_0013.JPG","IMG_0035.JPG","IMG_1868.JPG",
  "IMG_1910.JPG","IMG_1942.JPG","IMG_1945.JPG","PELATIHAN DAMKAR.JPG",
  "WhatsApp Image 2022-11-14 at 14.27.32.jpeg",
  "WhatsApp Image 2023-02-28 at 14.53.44 (1).jpeg",
  "WhatsApp Image 2023-12-01 at 15.00.51.jpeg",
  "WhatsApp Image 2024-11-24 at 17.21.34.jpeg",
  "WhatsApp Image 2025-03-16 at 22.03.25.jpeg",
  "WhatsApp Image 2025-03-16 at 22.04.39.jpeg",
  "WhatsAppImage2022-11-14at14.27.32.jpeg",
  "WhatsAppImage2023-02-28at14.53.44(1).jpeg",
  "WhatsAppImage2025-03-16at22.03.25.jpeg"
];

const CATEGORY_FALLBACKS: Record<string, string> = {
  'k3': 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=75&auto=format&fit=crop',
  'lingkungan': 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=600&q=75&auto=format&fit=crop',
  'system-management': 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=75&auto=format&fit=crop',
  'mining': 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=600&q=75&auto=format&fit=crop',
};

function stringHash(str: string): number {
  let hash = 0;
  for (let i = 0; i < str.length; i++) {
    const char = str.charCodeAt(i);
    hash = (hash << 5) - hash + char;
    hash |= 0; // Convert to 32bit integer
  }
  return Math.abs(hash);
}

/**
 * Returns a working URL for a training image.
 */
export function getTrainingImageUrl(imagePath?: string | null, catSlug: string = '', seed: string = ''): string {
  // If a valid custom path is provided that starts with / or http
  if (imagePath && (imagePath.startsWith('/') || imagePath.startsWith('http'))) {
    return imagePath;
  }

  // Deterministically map to actual gallery photos
  if (GALLERY_THUMBS.length > 0) {
    const key = seed || imagePath || catSlug || 'default-training';
    const index = stringHash(key) % GALLERY_THUMBS.length;
    const rawThumb = GALLERY_THUMBS[index];
    const webpThumb = rawThumb.replace(/\.[^.]+$/, '.webp');
    return `/galeri/thumbs/${encodeURIComponent(webpThumb)}`;
  }

  return CATEGORY_FALLBACKS[catSlug] || 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&q=75&auto=format&fit=crop';
}

/**
 * Format numeric price to Indonesian Rupiah
 */
export function formatPrice(price?: number | string | null): string {
  if (!price) return 'Hubungi Kami';
  const num = typeof price === 'string' ? parseInt(price, 10) : price;
  if (isNaN(num) || num <= 0) return 'Hubungi Kami';
  return 'Rp ' + num.toLocaleString('id-ID');
}

/**
 * Friendly label for training mode
 */
export function modeLabel(mode?: string | null): string {
  if (!mode) return 'Tatap Muka / Online';
  const m = mode.toLowerCase();
  if (m === 'online') return 'Online Zoom';
  if (m === 'offline') return 'Tatap Muka';
  if (m === 'blended') return 'Blended (Online + Praktek)';
  return mode.charAt(0).toUpperCase() + mode.slice(1);
}

/**
 * Formats WhatsApp URL with inquiry text
 */
export function waUrl(text: string, phone: string = '6287759151278'): string {
  return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
}

/**
 * Returns the full-size course banner path (1822×662 WebP).
 * Uses the reviewed program poster manifest.
 */
export function getCourseBanner(slug: string, _categorySlug: string = 'k3'): string {
  return posters[slug]?.image || '/assets/img/placeholder-training.svg';
}

/**
 * Returns the OG image path for a course (1200×630 WebP).
 * Uses the reviewed program poster manifest.
 */
export function getCourseOgBanner(slug: string): string {
  return posters[slug]?.ogImage || '/assets/img/og-cover.jpg';
}

/** Responsive poster sources for course heroes and catalog cards. */
export function getCourseBannerSrcSet(slug: string): string | undefined {
  const poster = posters[slug];
  return poster ? `${poster.image640} 640w, ${poster.image1200} 1200w, ${poster.image} 1822w` : undefined;
}
