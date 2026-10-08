'use client';

import { useEffect } from 'react';
import { usePathname } from 'next/navigation';

export default function ContentInteractions() {
  const pathname = usePathname();

  useEffect(() => {
    // 1. Reveal all elements immediately
    const revealEls = document.querySelectorAll<HTMLElement>('[data-reveal], .fade-in');
    revealEls.forEach((el) => {
      el.classList.add('is-visible', 'visible');
    });

    // 2. Re-execute inline tool scripts inside main#konten-utama
    const scripts = document.querySelectorAll<HTMLScriptElement>('#konten-utama script');
    scripts.forEach((oldScript) => {
      if (oldScript.dataset.executed) return;
      const newScript = document.createElement('script');
      Array.from(oldScript.attributes).forEach((attr) => {
        newScript.setAttribute(attr.name, attr.value);
      });
      newScript.appendChild(document.createTextNode(oldScript.innerHTML));
      newScript.dataset.executed = 'true';
      oldScript.parentNode?.replaceChild(newScript, oldScript);
    });

    // Trigger synthetic DOMContentLoaded so tool init functions run immediately
    if (scripts.length > 0) {
      window.dispatchEvent(new Event('DOMContentLoaded'));
      document.dispatchEvent(new Event('DOMContentLoaded'));
    }

    // 3. Global click handler for accordion and cookie banner
    const handleClick = (e: MouseEvent) => {
      const target = e.target as HTMLElement | null;
      if (!target) return;

      // FAQ Accordion toggle
      const faqBtn = target.closest<HTMLElement>('.faq-question, .st-faq-question');
      if (faqBtn) {
        const item = faqBtn.closest<HTMLElement>('.faq-item, .st-faq-item');
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
  }, [pathname]);

  return null;
}
