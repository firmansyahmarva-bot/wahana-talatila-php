(function () {
  'use strict';
  var root = document.body;
  var target = document.getElementById('live-schedule-grid');
  if (!target || !root.dataset.trainingSlug) return;

  var endpoint = '/api/public-schedules.php?training_slug=' + encodeURIComponent(root.dataset.trainingSlug)
    + '&city=' + encodeURIComponent(root.dataset.city || '');

  function esc(value) {
    var node = document.createElement('span');
    node.textContent = value == null ? '' : String(value);
    return node.innerHTML;
  }
  function dateID(value) {
    var date = new Date(value + 'T00:00:00');
    return isNaN(date) ? value : new Intl.DateTimeFormat('id-ID', {day:'numeric', month:'long', year:'numeric'}).format(date);
  }
  function money(value) {
    return Number(value) > 0 ? new Intl.NumberFormat('id-ID', {style:'currency', currency:'IDR', maximumFractionDigits:0}).format(value) : 'Hubungi untuk biaya';
  }
  function render(rows) {
    if (!rows.length) return;
    target.innerHTML = rows.map(function (row, index) {
      var place = row.mode === 'online' ? 'Online via Zoom' : (row.location || root.dataset.city || 'Lokasi diumumkan');
      return '<article class="city-live-card">'
        + '<span class="city-live-badge">' + (index === 0 ? 'Batch terdekat' : 'Pendaftaran dibuka') + '</span>'
        + '<div class="city-live-date">' + esc(dateID(row.start_date)) + '</div>'
        + '<div class="city-live-meta">' + esc(place) + ' · ' + esc(String(row.mode || '').toUpperCase()) + '</div>'
        + '<div class="city-live-price">' + esc(money(row.price)) + '</div>'
        + '<a class="city-live-link" href="' + esc(row.url) + '">Lihat batch &amp; daftar →</a>'
        + '</article>';
    }).join('');
  }

  fetch(endpoint, {headers:{'Accept':'application/json'}})
    .then(function (response) { if (!response.ok) throw new Error('schedule'); return response.json(); })
    .then(function (data) { if (data && data.success) render(data.schedules || []); })
    .catch(function () { /* Keep the useful static fallback in the clone/offline view. */ });
})();
