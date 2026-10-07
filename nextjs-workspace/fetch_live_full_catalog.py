import urllib.request
import xml.etree.ElementTree as ET
import json
import re
import os
import time
import sys

# Ensure UTF-8 output
if hasattr(sys.stdout, 'reconfigure'):
    sys.stdout.reconfigure(encoding='utf-8')

def get_sitemap_urls(sitemap_url):
    req = urllib.request.Request(sitemap_url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        with urllib.request.urlopen(req) as resp:
            root = ET.fromstring(resp.read())
            return [elem.text for elem in root.findall('.//{http://www.sitemaps.org/schemas/sitemap/0.9}loc')]
    except Exception as e:
        print(f"Error reading {sitemap_url}: {e}")
        return []

def extract_meta_and_body(html, url):
    slug = url.rstrip('/').split('/')[-1]
    
    # Extract title
    title_m = re.search(r'<title>(.*?)</title>', html, re.IGNORECASE | re.DOTALL)
    title = title_m.group(1).strip() if title_m else slug.replace('-', ' ').title()
    title = re.sub(r'\s*\|\s*Wahana Totalita.*', '', title, flags=re.IGNORECASE)
    
    # Extract meta desc
    desc_m = re.search(r'<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']', html, re.IGNORECASE | re.DOTALL)
    desc = desc_m.group(1).strip() if desc_m else ""
    
    # Extract main content / article body
    content = ""
    main_m = re.search(r'<main[^>]*>(.*?)</main>', html, re.IGNORECASE | re.DOTALL)
    if main_m:
        content = main_m.group(1).strip()
    else:
        article_m = re.search(r'<article[^>]*>(.*?)</article>', html, re.IGNORECASE | re.DOTALL)
        if article_m:
            content = article_m.group(1).strip()

    return {
        'slug': slug,
        'title': title,
        'meta_title': title,
        'meta_desc': desc,
        'description': desc,
        'content': content,
        'url': url
    }

def main():
    os.makedirs('src/data', exist_ok=True)

    # 1. Fetch all Articles (173 URLs)
    art_urls = get_sitemap_urls('https://wahanatotalita.com/sitemap-artikel.xml')
    print(f"Found {len(art_urls)} article URLs in live sitemap.")

    # Load existing articles if present
    existing_articles = {}
    if os.path.exists('src/data/articles.json'):
        try:
            with open('src/data/articles.json', 'r', encoding='utf-8') as f:
                existing_articles = json.load(f)
        except Exception:
            existing_articles = {}

    articles_data = {}
    for i, url in enumerate(art_urls):
        slug = url.rstrip('/').split('/')[-1]
        if not slug or slug == 'artikel':
            continue
        if slug in existing_articles and len(existing_articles[slug].get('content', '')) > 200:
            articles_data[slug] = existing_articles[slug]
            continue

        print(f"[{i+1}/{len(art_urls)}] Fetching article: {slug}")
        try:
            req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
            with urllib.request.urlopen(req, timeout=10) as resp:
                html = resp.read().decode('utf-8', errors='ignore')
                articles_data[slug] = extract_meta_and_body(html, url)
        except Exception as e:
            print(f"  Failed to fetch {slug}: {e}")
            articles_data[slug] = {
                'slug': slug,
                'title': slug.replace('-', ' ').title(),
                'meta_desc': f'Panduan dan artikel K3 mengenai {slug}.',
                'description': f'Panduan dan artikel K3 mengenai {slug}.',
                'url': url
            }
        time.sleep(0.05)

    with open('src/data/articles.json', 'w', encoding='utf-8') as f:
        json.dump(articles_data, f, indent=2, ensure_ascii=False)

    print(f"[SUCCESS] Saved ALL {len(articles_data)} Articles to src/data/articles.json!")

    # 2. Fetch all Training Courses (151 URLs)
    pel_urls = get_sitemap_urls('https://wahanatotalita.com/sitemap-pelatihan.xml')
    print(f"Found {len(pel_urls)} training URLs in live sitemap.")

    existing_trainings = {}
    if os.path.exists('src/data/trainings.json'):
        try:
            with open('src/data/trainings.json', 'r', encoding='utf-8') as f:
                existing_trainings = json.load(f)
        except Exception:
            existing_trainings = {}

    trainings_data = {}
    for i, url in enumerate(pel_urls):
        slug = url.rstrip('/').split('/')[-1]
        if not slug or slug in ['pelatihan', 'k3', 'system-management', 'lingkungan', 'mining']:
            continue
        if slug in existing_trainings and len(existing_trainings[slug].get('description', '')) > 100:
            trainings_data[slug] = existing_trainings[slug]
            continue

        print(f"[{i+1}/{len(pel_urls)}] Fetching training: {slug}")
        try:
            req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
            with urllib.request.urlopen(req, timeout=10) as resp:
                html = resp.read().decode('utf-8', errors='ignore')
                trainings_data[slug] = extract_meta_and_body(html, url)
                trainings_data[slug]['name'] = trainings_data[slug]['title']
        except Exception as e:
            print(f"  Failed to fetch {slug}: {e}")
            trainings_data[slug] = {
                'slug': slug,
                'name': slug.replace('-', ' ').title(),
                'meta_desc': f'Pelatihan dan Sertifikasi Resmi {slug}.',
                'description': f'Pelatihan dan Sertifikasi Resmi {slug}.',
                'url': url
            }
        time.sleep(0.05)

    with open('src/data/trainings.json', 'w', encoding='utf-8') as f:
        json.dump(trainings_data, f, indent=2, ensure_ascii=False)

    print(f"[SUCCESS] Saved ALL {len(trainings_data)} Training Courses to src/data/trainings.json!")

if __name__ == '__main__':
    main()
