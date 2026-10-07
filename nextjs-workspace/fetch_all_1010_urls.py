import urllib.request
import xml.etree.ElementTree as ET
import json
import re
import os
import time
import sys

if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(encoding='utf-8')

SITEMAPS = [
    'sitemap-core.xml',
    'sitemap-pelatihan.xml',
    'sitemap-artikel.xml',
    'sitemap-kota.xml',
    'sitemap-kota-pelatihan.xml',
    'sitemap-platform.xml',
    'sitemap-jadwal.xml',
    'sitemap-glosarium.xml',
    'sitemap-regulasi.xml',
    'sitemap-skkni.xml',
    'sitemap-riksa-uji.xml',
    'sitemap-perpanjangan-skp.xml',
    'sitemap-purnabakti.xml',
    'sitemap-event.xml'
]

def get_sitemap_urls(sitemap_file):
    url = f'https://wahanatotalita.com/{sitemap_file}'
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        with urllib.request.urlopen(req) as resp:
            root = ET.fromstring(resp.read())
            return [elem.text for elem in root.findall('.//{http://www.sitemaps.org/schemas/sitemap/0.9}loc')]
    except Exception as e:
        print(f"Error reading {url}: {e}")
        return []

def extract_meta_and_body(html, url):
    slug_path = url.replace('https://wahanatotalita.com/', '').strip('/')
    if not slug_path:
        slug_path = 'home'
    
    title_m = re.search(r'<title>(.*?)</title>', html, re.IGNORECASE | re.DOTALL)
    title = title_m.group(1).strip() if title_m else slug_path.replace('-', ' ').title()
    title = re.sub(r'\s*\|\s*Wahana Totalita.*', '', title, flags=re.IGNORECASE)
    
    desc_m = re.search(r'<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']', html, re.IGNORECASE | re.DOTALL)
    desc = desc_m.group(1).strip() if desc_m else ""
    
    content = ""
    main_m = re.search(r'<main[^>]*>(.*?)</main>', html, re.IGNORECASE | re.DOTALL)
    if main_m:
        content = main_m.group(1).strip()
    else:
        article_m = re.search(r'<article[^>]*>(.*?)</article>', html, re.IGNORECASE | re.DOTALL)
        if article_m:
            content = article_m.group(1).strip()

    return {
        'path': slug_path,
        'title': title,
        'meta_title': title,
        'meta_desc': desc,
        'description': desc,
        'content': content,
        'url': url
    }

def main():
    os.makedirs('src/data', exist_ok=True)
    all_pages = {}

    for sm in SITEMAPS:
        urls = get_sitemap_urls(sm)
        print(f"[{sm}] Processing {len(urls)} URLs...")
        for url in urls:
            path = url.replace('https://wahanatotalita.com/', '').strip('/')
            if not path:
                path = 'home'
            all_pages[path] = {
                'path': path,
                'title': path.replace('-', ' ').title(),
                'url': url
            }

    with open('src/data/all_site_pages.json', 'w', encoding='utf-8') as f:
        json.dump(all_pages, f, indent=2, ensure_ascii=False)

    print(f"[SUCCESS] Recorded ALL {len(all_pages)} URLs in src/data/all_site_pages.json!")

if __name__ == '__main__':
    main()
