(function () {
  'use strict';
  if (window.__wtLeadTracking) return;
  window.__wtLeadTracking = true;

  var pending = [];
  var ready = false;
  var checking = false;
  function send(payload) {
    pending.push(payload);
    function flush() {
      var queued = pending.splice(0);
      queued.forEach(function (item) { window.gtag('event', 'generate_lead', item); });
    }
    if (ready) { flush(); return; }
    if (checking) return;
    checking = true;
    var attempts = 0;
    function check() {
      if (ready) return;
      // GTM may be present before its Google tag is configured. Wait for the
      // documented client_id callback instead of losing an early event.
      window.gtag('get', window.__wtAnalytics.measurementId, 'client_id', function (id) {
        if (!id || ready) return;
        ready = true;
        flush();
      });
      if (++attempts < 12) setTimeout(check, Math.min(250 * Math.pow(2, attempts - 1), 2000));
      else checking = false;
    }
    check();
  }

  function position(link) {
    if (link.dataset.position) return link.dataset.position;
    if (link.closest('.hm-header')) return 'header';
    if (link.closest('.site-contact')) return 'contact_panel';
    if (link.closest('.hm-footer')) return 'footer';
    if (link.closest('.ce-registration, .pd-cta-box')) return 'registration';
    if (link.closest('.ce-inhouse, .dir-inhouse, .pcat-b2b-box')) return 'inhouse';
    if (link.closest('.ce-schedule-card, .dir-batch, .tc-schedule-card')) return 'schedule_card';
    if (link.closest('.training-card, .dir-link-card')) return 'training_card';
    if (link.closest('.ar-conversion')) return 'article';
    if (link.closest('.hero, .directory-header, .ce-hero')) return 'hero';
    return 'page_content';
  }

  document.addEventListener('click', function (event) {
    var target = event.target instanceof Element ? event.target : event.target && event.target.parentElement;
    var link = target && target.closest('a[href]');
    if (!link || !window.__wtAnalytics) return;
    var url;
    try { url = new URL(link.href, location.href); } catch (_) { return; }
    var host = url.hostname.toLowerCase();
    if (!['wa.me', 'api.whatsapp.com', 'web.whatsapp.com', 'whatsapp.com'].includes(host)) return;
    if (typeof window.gtag !== 'function') return;
    var path = location.pathname;
    var match = path.match(/^\/(?:pelatihan|jadwal)\/([^/]+)\//);
    var card = link.closest('[data-slug]');
    var slug = (card && card.dataset.slug) || (match && match[1]) || '';
    var payload = {
      lead_type: 'whatsapp',
      event_category: 'whatsapp_click',
      page_path: path,
      course_slug: slug,
      cta_position: position(link),
      // Do not send WhatsApp messages, phone numbers or user-entered form values.
      link_domain: host,
      transport_type: 'beacon'
    };
    if (window.__wtAnalytics.measurementId) payload.send_to = window.__wtAnalytics.measurementId;
    if (window.__wtAnalytics.debug) payload.debug_mode = true;
    // One dispatch path. The published GTM link trigger independently owns whatsapp_click.
    send(payload);
  }, { capture: true, passive: true });
})();
