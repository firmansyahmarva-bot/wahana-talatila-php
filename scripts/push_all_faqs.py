"""
scripts/push_all_faqs.py
Pushes full FAQ data to all 20 articles using both 'faq' and 'faq_data' keys.
"""
import sys
import os
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), '..')))

import urllib.request
import json
import scripts.deep_rewrite_batch_1_to_5 as b1
import scripts.deep_rewrite_batch_6_to_10 as b2
import scripts.deep_rewrite_batch_11_to_15 as b3
import scripts.deep_rewrite_batch_16_to_20 as b4

API_URL = "https://wahanatotalita.com/api/articles.php"
API_KEY = "wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f"

all_items = (
    b1.articles_data +
    b2.articles_data_batch2 +
    b3.articles_data_batch3 +
    b4.articles_data_batch4
)

# Also include article 18 (K3RS)
art18_faqs = [
    {
        "question": "Apakah seluruh rumah sakit di Indonesia wajib menerapkan K3RS?",
        "answer": "Ya, tanpa kecuali. Berdasarkan UU No. 17 Tahun 2023 tentang Kesehatan dan Permenkes No. 66 Tahun 2016, seluruh fasilitas pelayanan kesehatan (Rumah Sakit Tipe A, B, C, D, RS Khusus, hingga Puskesmas Rawat Inap) wajib menyelenggarakan K3RS dan membentuk Komite/Instalasi K3RS."
    },
    {
        "question": "Apa perbedaan antara Komite K3RS dan Instalasi K3RS?",
        "answer": "Pada rumah sakit tipe A dan B (skala besar), K3RS umumnya berbentuk Instalasi K3RS struktural mandiri dengan personil purna waktu (full-time). Sedangkan pada rumah sakit tipe C dan D, pengorganisasian dapat berupa Komite K3RS fungsional yang beranggotakan perwakilan dari unit medis, keperawatan, penunjang, dan sarana prasarana."
    },
    {
        "question": "Apakah sertifikasi Petugas K3RS BNSP diakui oleh Kementerian Kesehatan?",
        "answer": "Sangat diakui. Sertifikat Petugas K3RS yang diterbitkan oleh Badan Nasional Sertifikasi Profesi (BNSP) berlogo Garuda Emas merupakan bukti kompetensi profesi standar nasional yang diakui oleh Komisi Akreditasi Rumah Sakit (KARS) dan Kementerian Kesehatan dalam pemenuhan standar STARKES Bab MFK."
    },
    {
        "question": "Berapa lama masa berlaku sertifikat kompetensi Petugas K3RS BNSP?",
        "answer": "Sertifikat Kompetensi Petugas K3RS BNSP berlaku selama 3 (tiga) tahun sejak tanggal diterbitkan dan dapat diperpanjang melalui asesmen portofolio pemeliharaan kompetensi di Lembaga Sertifikasi Profesi (LSP) terlisensi."
    },
    {
        "question": "Bagaimana prosedur penanganan darurat jika perawat tertusuk jarum suntik bekas pasien?",
        "answer": "SOP Needle Stick Injury (NSI) mewajibkan: (1) Jangan memijat luka, (2) Cuci segera di bawah air mengalir dengan sabun antiseptik minimal 5 menit, (3) Lapor segera ke Instalasi K3RS dalam waktu kurang dari 2 jam, (4) Periksa status infeksi pasien sumber (HBsAg, Anti-HCV, Anti-HIV), (5) Berikan Profilaksis Pasca Pajanan (PPP / PEP) dalam waktu kurang dari 4 jam jika pasien reaktif."
    }
]

all_items.append({
    "slug": "standar-k3-rumah-sakit-permenkes-66-2016-sertifikasi-petugas-k3rs",
    "faq_data": art18_faqs
})

print(f"Total articles to update FAQs for: {len(all_items)}")

for item in all_items:
    slug = item["slug"]
    faqs = item.get("faq_data", [])
    payload = {
        "slug": slug,
        "faq": faqs,
        "faq_data": faqs
    }
    req = urllib.request.Request(
        API_URL,
        data=json.dumps(payload, ensure_ascii=False).encode('utf-8'),
        headers={
            "Authorization": f"Bearer {API_KEY}",
            "Content-Type": "application/json",
            "Accept": "application/json",
            "User-Agent": "Mozilla/5.0"
        },
        method="PUT"
    )
    with urllib.request.urlopen(req) as resp:
        res = json.loads(resp.read().decode('utf-8'))
        returned_faqs = res.get("data", {}).get("faq", [])
        print(f"Updated {slug}: {len(returned_faqs)} FAQs saved")

print("\nAll FAQs successfully synced to production!")
