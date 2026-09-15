WAHANA TOTALITA — NAVBAR WHITE-ON-WHITE + FONT-SIZE FIX — 2026-07-21
Mirrors public_html. Upload each file to the same path (overwrite existing).

FILES CHANGED (3)
------------------
1. assets/css/style.css
   - Added a new opt-in rule block (`.navbar.on-light-hero`) right after
     the existing `.nav-links a:hover` rule (~line 136). Does not modify,
     remove, or override any existing selector — pure addition.
   - Changed `.detail-desc` font-size from 15px to 16px (~line 715) and
     made this the single authoritative rule (see file #2).

2. pelatihan.php
   - Navbar tag: `class="navbar"` -> `class="navbar on-light-hero"` (~line 269).
   - Removed the duplicate/conflicting `.detail-desc{font-size:14.5px;
     line-height:1.75;}` rule from this file's own inline <style> block
     (was ~line 242) — this was silently overriding style.css's rule via
     later source order, which is why edits to style.css alone never had
     any visible effect.

3. pelatihan-catalog.php
   - Navbar tag: same class addition as pelatihan.php (~line 78). This
     page (`/pelatihan`, the training catalog index) has the same
     structural issue — fixed transparent navbar, no dark hero behind it,
     just body/breadcrumb-bar background.

ROOT CAUSE (for reference — full writeup already in wahana_work/TASKS.md)
---------------------------------------------------------------------------
`.navbar` defaults to `background:transparent` + white text, designed for
pages with a dark hero directly underneath. JS only switches it to solid/
dark (`.scrolled` class) once scrollY > 40px. pelatihan.php and
pelatihan-catalog.php have no dark hero — just a plain body background —
so on load, before any scroll, the transparent white-text navbar sat
directly on a light background = invisible until scroll or hover.

HOW THE FIX WORKS
-------------------
`.navbar.on-light-hero:not(.scrolled)` applies the exact same "solid navbar,
dark text" look that `.navbar.scrolled` already provides — just as the
STARTING state instead of only the post-scroll state. The `:not(.scrolled)`
guard means once the user actually scrolls past 40px, the real `.scrolled`
class takes over exactly as before — shadow, blur, everything unchanged.
Hover/active states on nav links were never touched by this fix at all.

WHAT THIS DOES NOT TOUCH
--------------------------
- No page's URL, canonical, or routing.
- No other template's navbar (csms.php, layanan-pemerintah.php have dark
  hero images — correctly unaffected and untouched; jadwal-pelatihan.php
  has its own separate, self-contained navbar CSS, not this shared system
  at all; homepage's hero is a real photo slideshow — dark backdrop,
  correctly unaffected).
- No hover/focus/active navbar styling — same rules as before, unchanged.

VERIFIED BEFORE DELIVERY
--------------------------
- Both PHP files pass `php -l` (syntax clean).
- style.css brace count balanced (467 open / 467 close).
- Local extracted7/ copy and this batch folder are byte-identical (diffed).
- Root cause and fix logic verified against the LIVE style.css fetched
  fresh via HTTP (not a stale local copy) before writing the patch.

NOT YET VERIFIED (can't be, until this is live)
---------------------------------------------------
This is a local-file fix awaiting upload — it has not been tested against
the actual live site because the live site doesn't have it yet. After you
upload, re-check:
- https://wahanatotalita.com/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/
  — header should be readable immediately, no scroll/hover/selection needed.
- https://wahanatotalita.com/pelatihan/ (catalog page) — same check.
- Scroll down on either page — shadow/blur navbar transition should look
  exactly as it did before (untouched).
- Hover a nav link — should still highlight green as before (untouched).
- Also worth a look at real mobile/tablet width in an actual phone/tablet
  or browser dev tools, and in more than one real browser if you have them
  handy (Chrome/Edge/Firefox/Safari) — I verified this logically against
  the CSS source and via a single sandboxed browser tool, which is not a
  substitute for real multi-browser/device testing.

SCOPE NOTE — other templates not covered by this fix
--------------------------------------------------------
This shared navbar+CSS pattern is also used by ~26 other page templates
(via includes/navbar.php or root navbar.php — homepage, artikel pages,
404, perusahaan, and 20 industry-vertical pages like k3-manufaktur.php,
k3-perkantoran.php, akomodasi.php, etc.). I checked several representative
ones: homepage (photo hero slideshow), csms.php, layanan-pemerintah.php
(dark gradient heroes) — all confirmed NOT affected, left untouched. The
remaining ~20+ templates using the shared includes were NOT individually
checked for hero color — full list and follow-up plan logged in
wahana_work/TASKS.md under "still needs the same per-template check."
