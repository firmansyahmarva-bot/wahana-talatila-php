'use client';

import { useEffect } from 'react';

export default function ContentInteractions() {
  useEffect(() => {
    // 1. Reveal all elements immediately and observe if scrolling
    const revealEls = document.querySelectorAll<HTMLElement>('[data-reveal], .fade-in');
    revealEls.forEach((el) => {
      el.classList.add('is-visible', 'visible');
    });

    // 2. Global click handler for accordion and cookie banner
    const handleClick = (e: MouseEvent) => {
      const target = e.target as HTMLElement | null;
      if (!target) return;

      // FAQ Accordion toggle
      const faqBtn = target.closest<HTMLElement>('.faq-question');
      if (faqBtn) {
        const item = faqBtn.closest<HTMLElement>('.faq-item');
        if (item) {
          const isOpen = item.classList.contains('open');
          item.classList.toggle('open');
          faqBtn.setAttribute('aria-expanded', String(!isOpen));
        }
        return;
      }

      // Cookie consent banner accept
      const cookieBtn = target.closest<HTMLElement>('#cookie-accept, .cookie-btn');
      if (cookieBtn) {
        const banner = cookieBtn.closest<HTMLElement>('.cookie-banner');
        if (banner) {
          banner.style.display = 'none';
          try {
            localStorage.setItem('wt_cookie_accepted', 'true');
          } catch {
            // ignore in private browsing
          }
        }
        return;
      }
    };

    document.addEventListener('click', handleClick);
    return () => document.removeEventListener('click', handleClick);
  }, []);

  return null;
}
