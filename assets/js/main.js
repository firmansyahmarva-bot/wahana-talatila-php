/* ============================================================
   Wahana Totalita Konsultan — main.js
   ============================================================ */

// ─── Scroll Progress Bar ─────────────────────────────────────
(function () {
  var bar = document.getElementById('scroll-progress');
  if (!bar) return;
  var ticking = false;
  window.addEventListener('scroll', function () {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        var docH = document.documentElement.scrollHeight - window.innerHeight;
        var progress = docH > 0 ? Math.min(window.scrollY / docH, 1) : 0;
        bar.style.transform = 'scaleX(' + progress + ')';
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
})();

// ─── Navbar: transparent → white on scroll ───────────────────
const navbar = document.getElementById('navbar');
if (navbar) {
  let navTicking = false;
  const updateNav = () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
    navTicking = false;
  };
  window.addEventListener('scroll', () => {
    if (!navTicking) {
      window.requestAnimationFrame(updateNav);
      navTicking = true;
    }
  }, { passive: true });
  // Avoid forced synchronous reflow during HTML parsing/script eval; check via rAF
  if (typeof requestAnimationFrame !== 'undefined') {
    requestAnimationFrame(() => {
      if (window.scrollY > 40) navbar.classList.add('scrolled');
    });
  }
}

// ─── Mobile hamburger ────────────────────────────────────────
const hamburger = document.getElementById('nav-hamburger');
const navLinks  = document.getElementById('nav-links');
if (hamburger && navLinks) {
  hamburger.addEventListener('click', () => {
    const open = navLinks.classList.toggle('open');
    hamburger.setAttribute('aria-expanded', open);
  });
  document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !navLinks.contains(e.target)) {
      navLinks.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
    }
  });
}

// ─── Training catalog filter ─────────────────────────────────
let activeCategory = 'all';
let activeMode     = 'all';

function applyFilter() {
  const cards = document.querySelectorAll('#training-grid .training-card');
  let visible = 0;
  cards.forEach(card => {
    const cat  = card.dataset.cat  || '';
    const mode = card.dataset.mode || '';
    const catMatch  = activeCategory === 'all' || cat === activeCategory;
    const modeMatch = activeMode === 'all'
      || mode === activeMode
      || mode === 'both';
    const show = catMatch && modeMatch;
    card.dataset.hidden = show ? 'false' : 'true';
    if (show) visible++;
  });
  const empty = document.getElementById('filter-empty');
  if (empty) empty.style.display = visible === 0 ? 'block' : 'none';
}

window.filterCategory = function(slug) {
  activeCategory = slug;
  document.querySelectorAll('#filter-cat .filter-btn').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.filter === slug);
  });
  applyFilter();
};

window.filterMode = function(mode) {
  activeMode = mode;
  document.querySelectorAll('#filter-mode .filter-mode').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.mode === mode);
  });
  applyFilter();
};

// ─── Smooth scroll for anchor links ─────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const top = target.getBoundingClientRect().top + window.scrollY - 80;
      window.scrollTo({ top, behavior: 'smooth' });
      navLinks && navLinks.classList.remove('open');
    }
  });
});

// ─── Catalog keyword search ──────────────────────────────────
(function () {
  var input = document.getElementById('catalog-search');
  if (!input) return;
  input.addEventListener('input', function () {
    var q = this.value.trim().toLowerCase();
    var cards = document.querySelectorAll('#training-grid .training-card');
    cards.forEach(function (card) {
      if (card.dataset.hidden === 'true') return; // respect category filter
      var title = card.querySelector('.training-card-title');
      if (!title) return;
      var text = title.textContent.toLowerCase();
      var show = !q || text.includes(q);
      card.style.display = show ? '' : 'none';
    });
  });
})();

// ─── FAQ Accordion ───────────────────────────────────────────
document.querySelectorAll('.faq-question').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var item = this.closest('.faq-item');
    var isOpen = item.classList.contains('open');
    // close all
    document.querySelectorAll('.faq-item.open').forEach(function (el) {
      el.classList.remove('open');
      el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
    });
    if (!isOpen) {
      item.classList.add('open');
      this.setAttribute('aria-expanded', 'true');
    }
  });
});

// ─── Animated number counters ────────────────────────────────
(function () {
  function animateCounter(el, target, suffix) {
    var start = 0;
    var duration = 1600;
    var startTime = null;
    function step(ts) {
      if (!startTime) startTime = ts;
      var progress = Math.min((ts - startTime) / duration, 1);
      var ease = 1 - Math.pow(1 - progress, 3);
      var val = Math.floor(ease * target);
      el.textContent = val.toLocaleString('id-ID') + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  var counterEls = document.querySelectorAll('[data-count]');
  if (!counterEls.length || !('IntersectionObserver' in window)) return;
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      var el     = entry.target;
      var target = parseInt(el.dataset.count, 10);
      var suffix = el.dataset.suffix || '';
      animateCounter(el, target, suffix);
      obs.unobserve(el);
    });
  }, { threshold: 0.5 });
  counterEls.forEach(function (el) { obs.observe(el); });
})();

// ─── Scroll Reveal & Fade-in (IntersectionObserver) ─────────
(function () {
  const revealEls = document.querySelectorAll('[data-reveal], .fade-in');
  if (!revealEls.length) return;

  if ('IntersectionObserver' in window && window.matchMedia('(min-width: 769px)').matches) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible', 'visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0, rootMargin: '0px 0px -40px 0px' });

    revealEls.forEach(el => observer.observe(el));

    // Safety net: force visible after 2s so nothing stays blank
    setTimeout(() => {
      revealEls.forEach(el => el.classList.add('is-visible', 'visible'));
    }, 2000);
  } else {
    revealEls.forEach(el => el.classList.add('is-visible', 'visible'));
  }
})();

// ─── WA Float Cueing at 40% Scroll Depth ─────────────────────
(function () {
  var wa = document.querySelector('.wa-float');
  if (!wa) return;
  var triggered = false;
  function onScrollCue() {
    if (triggered) return;
    var scrollY = window.pageYOffset || document.documentElement.scrollTop;
    var docH = document.documentElement.scrollHeight - window.innerHeight;
    if (docH > 0 && (scrollY / docH) >= 0.4) {
      triggered = true;
      wa.classList.add('is-cueing');
      window.removeEventListener('scroll', onScrollCue);
      wa.addEventListener('animationend', function () {
        wa.classList.remove('is-cueing');
      }, { once: true });
    }
  }
  window.addEventListener('scroll', onScrollCue, { passive: true });
})();
