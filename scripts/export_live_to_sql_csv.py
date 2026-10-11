"""
scripts/export_live_to_sql_csv.py
Fetches all 20 live articles from production API and exports them into
scripts/20_new_articles.sql and admin/20_new_articles_wahana.csv.
"""
import urllib.request
import json
import csv
import os

API_URL = "https://wahanatotalita.com/api/articles.php"
API_KEY = "wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f"

slugs = [
    "biaya-pelatihan-ahli-k3-umum-kemnaker-2026",
    "syarat-ahli-k3-umum-kemnaker-non-teknik",
    "masa-berlaku-sertifikat-ahli-k3-umum-perpanjangan-skp",
    "perbedaan-ahli-k3-umum-vs-ahli-k3-spesialis",
    "syarat-biaya-ahli-muda-k3-konstruksi-tender-lpse",
    "cara-mendapatkan-sio-lisensi-k3-operator-forklift-kemnaker",
    "standar-k3-scaffolding-kualifikasi-teknisi-inspeksi-perancah",
    "panduan-sertifikasi-ahli-k3-listrik-teknisi-k3-listrik-kemnaker",
    "kewajiban-sertifikasi-teknisi-confined-space-ruang-terbatas",
    "panduan-sertifikasi-tkbt-ii-tkpk-kemnaker-pekerja-ketinggian",
    "pelatihan-damkar-kelas-d-c-b-a-kemnaker-kualifikasi",
    "sertifikasi-pplb3-bnsp-syarat-uji-kompetensi-limbah-b3",
    "kewajiban-sertifikasi-pppa-pppu-bnsp-industri-pabrik",
    "cara-menjadi-lead-auditor-iso-45001-syarat-peluang-karir",
    "panduan-csms-kontraktor-lolos-prakualifikasi-tender",
    "tugas-tanggung-jawab-ahli-k3-umum-perusahaan-permenaker-2-1992",
    "perbedaan-pop-pom-pou-pertambangan-bnsp-jenjang-karir",
    "standar-k3-rumah-sakit-permenkes-66-2016-sertifikasi-petugas-k3rs",
    "panduan-sertifikasi-juru-las-welder-kelas-1-2-3-kemnaker",
    "metode-investigasi-kecelakaan-kerja-root-cause-analysis-scat"
]

sql_lines = [
    "-- 20 Masterclass In-Depth (>= 1,500 words each) Articles for Wahana Totalita",
    "-- Auto-exported from Production API",
    ""
]

csv_rows = []

for slug in slugs:
    req = urllib.request.Request(
        f"{API_URL}?slug={slug}",
        headers={"Authorization": f"Bearer {API_KEY}", "User-Agent": "Mozilla/5.0"}
    )
    with urllib.request.urlopen(req) as resp:
        data = json.loads(resp.read().decode('utf-8'))['data']
        title = data.get('title', '').replace("'", "''")
        s = data.get('slug', '')
        meta_title = data.get('meta_title', '').replace("'", "''")
        meta_desc = data.get('meta_desc', '').replace("'", "''")
        keywords = data.get('keywords', '').replace("'", "''")
        cat = data.get('category', 'K3').replace("'", "''")
        author = data.get('author', 'Wahana Totalita Konsultan').replace("'", "''")
        content = data.get('content', '').replace("'", "''")
        faq_data = json.dumps(data.get('faq', []), ensure_ascii=False).replace("'", "''")

        sql_lines.append(f"INSERT INTO `articles` (`title`, `slug`, `meta_title`, `meta_desc`, `keywords`, `category`, `thumbnail`, `content`, `faq_data`, `author`, `status`, `published_at`, `created_at`, `updated_at`)")
        sql_lines.append(f"VALUES ('{title}', '{s}', '{meta_title}', '{meta_desc}', '{keywords}', '{cat}', '', '{content}', '{faq_data}', '{author}', 'published', NOW(), NOW(), NOW())")
        sql_lines.append(f"ON DUPLICATE KEY UPDATE `content` = VALUES(`content`), `meta_desc` = VALUES(`meta_desc`), `meta_title` = VALUES(`meta_title`), `keywords` = VALUES(`keywords`), `faq_data` = VALUES(`faq_data`), `updated_at` = NOW();\n")

        csv_rows.append({
            'title': data.get('title', ''),
            'slug': s,
            'category': data.get('category', 'K3'),
            'meta_title': data.get('meta_title', ''),
            'meta_desc': data.get('meta_desc', ''),
            'keywords': data.get('keywords', ''),
            'content': data.get('content', ''),
            'faq': json.dumps(data.get('faq', []), ensure_ascii=False)
        })

sql_path = os.path.join(os.path.dirname(__file__), '20_new_articles.sql')
with open(sql_path, 'w', encoding='utf-8') as f:
    f.write('\n'.join(sql_lines))
print(f"Written SQL: {sql_path} ({os.path.getsize(sql_path):,} bytes)")

csv_path = os.path.join(os.path.dirname(__file__), '..', 'admin', '20_new_articles_wahana.csv')
with open(csv_path, 'w', encoding='utf-8', newline='') as f:
    writer = csv.DictWriter(f, fieldnames=['title', 'slug', 'category', 'meta_title', 'meta_desc', 'keywords', 'content', 'faq'])
    writer.writeheader()
    writer.writerows(csv_rows)
print(f"Written CSV: {csv_path} ({os.path.getsize(csv_path):,} bytes)")
