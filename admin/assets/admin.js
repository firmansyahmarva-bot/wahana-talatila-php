/**
 * Wahana Totalita — Admin Panel JS
 */
(function () {
  'use strict';

  // ── Sidebar toggle (mobile) ─────────────────────────────────────────────
  const sidebar  = document.getElementById('sidebar');
  const overlay  = document.getElementById('mobileOverlay');
  const hamburger = document.getElementById('hamburger');
  const closeBtn  = document.getElementById('sidebarClose');

  function openSidebar()  { sidebar?.classList.add('open'); overlay?.classList.add('open'); }
  function closeSidebar() { sidebar?.classList.remove('open'); overlay?.classList.remove('open'); }

  hamburger?.addEventListener('click', openSidebar);
  closeBtn?.addEventListener('click', closeSidebar);
  overlay?.addEventListener('click', closeSidebar);

  // ── Modal ───────────────────────────────────────────────────────────────
  window.openModal = function (id) {
    const m = document.getElementById(id);
    m?.classList.add('open');
    document.body.style.overflow = 'hidden';
  };
  window.closeModal = function (id) {
    const m = document.getElementById(id);
    m?.classList.remove('open');
    document.body.style.overflow = '';
  };
  // Close modal on overlay click
  document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeModal(overlay.id);
    });
  });
  // Escape key closes modal
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.open').forEach(function (m) {
        closeModal(m.id);
      });
    }
  });

  // ── Flash message auto-dismiss ──────────────────────────────────────────
  var flash = document.getElementById('flash-message');
  if (flash) {
    setTimeout(function () {
      flash.style.transition = 'opacity .4s';
      flash.style.opacity = '0';
      setTimeout(function () { flash.remove(); }, 400);
    }, 4000);
  }

  // ── Filter chips ────────────────────────────────────────────────────────
  document.querySelectorAll('.filter-chips').forEach(function (group) {
    group.querySelectorAll('.filter-chip').forEach(function (chip) {
      chip.addEventListener('click', function () {
        group.querySelectorAll('.filter-chip').forEach(function (c) { c.classList.remove('active'); });
        chip.classList.add('active');
        var filter = chip.dataset.filter;
        var table  = document.getElementById('filterTable');
        if (!table) return;
        table.querySelectorAll('tr[data-status]').forEach(function (row) {
          row.style.display = (!filter || filter === 'all' || row.dataset.status === filter) ? '' : 'none';
        });
      });
    });
  });

  // ── Search ──────────────────────────────────────────────────────────────
  var searchInputs = document.querySelectorAll('.search-input');
  searchInputs.forEach(function (input) {
    input.addEventListener('input', function () {
      var q   = input.value.toLowerCase().trim();
      var tid = input.dataset.target || 'filterTable';
      var tbl = document.getElementById(tid);
      if (!tbl) return;
      tbl.querySelectorAll('tr[data-search]').forEach(function (row) {
        row.style.display = (!q || row.dataset.search.toLowerCase().includes(q)) ? '' : 'none';
      });
    });
  });

  // ── Confirm delete ──────────────────────────────────────────────────────
  window.confirmDelete = function (msg, formId) {
    if (confirm(msg || 'Yakin ingin menghapus data ini?')) {
      if (formId) document.getElementById(formId)?.submit();
    }
  };

  // ── Format currency ─────────────────────────────────────────────────────
  window.formatRupiah = function (num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  };

  // ── Days left badge color ────────────────────────────────────────────────
  window.daysLeftBadge = function (days) {
    if (days < 0)  return 'badge-expired';
    if (days <= 7) return 'badge-expiring';
    if (days <= 30) return 'badge-expiring';
    return 'badge-active';
  };

  // ── WhatsApp send ────────────────────────────────────────────────────────
  window.sendWA = function (phone, message) {
    var clean = phone.replace(/\D/g, '');
    if (clean.startsWith('0')) clean = '62' + clean.slice(1);
    if (!clean.startsWith('62')) clean = '62' + clean;
    var url = 'https://wa.me/' + clean + '?text=' + encodeURIComponent(message);
    window.open(url, '_blank');
  };

  // ── Dynamic invoice total ────────────────────────────────────────────────
  function recalcInvoice() {
    var subtotal = 0;
    document.querySelectorAll('.item-qty, .item-price').forEach(function () {});
    document.querySelectorAll('tr.invoice-item-row').forEach(function (row) {
      var qty   = parseFloat(row.querySelector('.item-qty')?.value   || 0);
      var price = parseFloat(row.querySelector('.item-price')?.value || 0);
      var total = qty * price;
      var tf = row.querySelector('.item-total');
      if (tf) tf.value = total.toFixed(0);
      subtotal += total;
    });
    var disc = parseFloat(document.getElementById('invoice-discount')?.value || 0);
    var tax  = parseFloat(document.getElementById('invoice-tax')?.value || 0);
    var total = subtotal - disc + tax;
    var stEl = document.getElementById('invoice-subtotal');
    var ttEl = document.getElementById('invoice-total');
    if (stEl) stEl.textContent = formatRupiah(subtotal);
    if (ttEl) ttEl.textContent = formatRupiah(total);
    var hidTotal = document.getElementById('invoice-total-hidden');
    if (hidTotal) hidTotal.value = total.toFixed(0);
  }
  document.querySelectorAll('.item-qty, .item-price, #invoice-discount, #invoice-tax')
    .forEach(function (el) { el.addEventListener('input', recalcInvoice); });

  // ── Add invoice item row ──────────────────────────────────────────────────
  window.addInvoiceRow = function () {
    var tbody = document.getElementById('invoice-items-body');
    if (!tbody) return;
    var idx = tbody.querySelectorAll('tr').length;
    var row = document.createElement('tr');
    row.className = 'invoice-item-row';
    row.innerHTML = '<td><input class="form-input form-input-sm" name="items['+idx+'][description]" required></td>' +
      '<td style="width:80px"><input class="form-input form-input-sm item-qty" name="items['+idx+'][quantity]" type="number" value="1" min="1"></td>' +
      '<td style="width:130px"><input class="form-input form-input-sm item-price" name="items['+idx+'][unit_price]" type="number" value="0"></td>' +
      '<td style="width:130px"><input class="form-input form-input-sm item-total" name="items['+idx+'][total]" type="number" readonly></td>' +
      '<td><button type="button" class="btn btn-xs btn-danger" onclick="this.closest(\'tr\').remove(); recalcInvoice()">✕</button></td>';
    tbody.appendChild(row);
    row.querySelectorAll('.item-qty, .item-price').forEach(function (el) {
      el.addEventListener('input', recalcInvoice);
    });
  };

  // ── Tooltip ──────────────────────────────────────────────────────────────
  document.querySelectorAll('[data-tip]').forEach(function (el) {
    el.setAttribute('title', el.dataset.tip);
  });

  // ── Date range highlight on certifications ────────────────────────────────
  document.querySelectorAll('.expiry-date').forEach(function (el) {
    var d = new Date(el.dataset.date);
    var now = new Date();
    var diff = Math.round((d - now) / 86400000);
    if (diff < 0) { el.classList.add('text-danger'); }
    else if (diff <= 30) { el.classList.add('text-warning'); }
    else { el.classList.add('text-success'); }
  });

})();

/* ── CSS helpers from JS ─────────────────────────────────── */
document.head.insertAdjacentHTML('beforeend', '<style>' +
  '.text-danger{color:#ef4444;font-weight:700}' +
  '.text-warning{color:#d97706;font-weight:700}' +
  '.text-success{color:#166534}' +
  '.form-input-sm{padding:5px 8px;font-size:12px}' +
  '</style>');
