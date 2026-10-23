import { getCollection, type CollectionEntry } from 'astro:content';
import { trainingCatalog, type TrainingRecord } from './trainingCatalog';
export type ArticleRecord = CollectionEntry<'articles'>['data'];
export type ArticleTopic = 'k3' | 'lingkungan' | 'mining' | 'system-management';
export const ARTICLE_PAGE_SIZE = 24;
export const ARTICLE_TOPICS: {slug: ArticleTopic; label: string}[] = [
  {slug:'k3',label:'K3 & Keselamatan'}, {slug:'lingkungan',label:'Lingkungan'},
  {slug:'mining',label:'Pertambangan'}, {slug:'system-management',label:'ISO & SMK3'},
];
const STOP = new Set('yang dan di ke dari untuk dengan adalah atau pada dalam ini itu cara panduan lengkap tentang apa bagaimana mengapa wajib indonesia pelatihan sertifikasi ahli kerja keselamatan kesehatan perusahaan umum k3 syarat tugas tahun terbaru'.split(' '));
export function plainText(html = ''): string {
  return html.replace(/<[^>]*>/g,' ').replace(/&(?:nbsp|amp|quot|apos|lt|gt|ndash|mdash|hellip);|&#(?:x[0-9a-f]+|\d+);/gi, entity => {
    const values: Record<string,string> = {'&nbsp;':' ','&amp;':'&','&quot;':'"','&apos;':"'",'&lt;':'<','&gt;':'>','&ndash;':'–','&mdash;':'—','&hellip;':'…'};
    if (values[entity]) return values[entity];
    const value = entity.slice(2,-1); const code = parseInt(value.replace(/^x/i,''), /^x/i.test(value) ? 16 : 10);
    return Number.isFinite(code) && code <= 0x10ffff ? String.fromCodePoint(code) : entity;
  }).replace(/\s+/g,' ').trim();
}
export function topicFor(article: Pick<ArticleRecord,'category'|'title'|'topic'>): ArticleTopic {
  if (article.topic) return article.topic;
  const category=(article.category || '').toLowerCase();
  if (/lingkungan/.test(category)) return 'lingkungan';
  if (/mining|tambang/.test(category)) return 'mining';
  if (/system|qhse|iso|manajemen/.test(category) || /\b(iso|smk3)\b/i.test(article.title)) return 'system-management';
  return 'k3';
}
export function readingMinutes(article: ArticleRecord) { return Math.max(1,Math.ceil(plainText(article.content || '').split(/\s+/).length / 220)); }
export function articleDate(value?: string | null) {
  if (!value) return '';
  const date = new Date(value.includes('T') ? value : value.replace(' ','T'));
  return Number.isNaN(date.getTime()) ? '' : new Intl.DateTimeFormat('id-ID',{day:'numeric',month:'long',year:'numeric',timeZone:'Asia/Jakarta'}).format(date);
}
function terms(value: string) { return new Set((plainText(value).toLowerCase().normalize('NFKD').match(/[\p{L}\p{N}]+/gu) || []).filter(term => term.length > 1 && !STOP.has(term))); }
export function prepareArticleContent(content = '') {
  const used = new Set([...content.matchAll(/\bid\s*=\s*["']([^"']+)["']/gi)].map(match=>match[1]));
  const headings: {id:string;text:string;level:number}[]=[];
  const html=content.replace(/<h([23])\b([^>]*)>([\s\S]*?)<\/h\1>/gi, (full,level,attrs,body) => {
    const text=plainText(body); if (!text) return full;
    const existing=attrs.match(/\bid\s*=\s*["']([^"']+)["']/i)?.[1];
    let id=existing;
    if (!id) { const base='bagian-'+(text.toLowerCase().normalize('NFKD').replace(/[^\p{L}\p{N}]+/gu,'-').replace(/^-|-$/g,'') || 'panduan'); id=base;let suffix=2;while(used.has(id))id=base+'-'+suffix++;used.add(id); }
    headings.push({id:id!,text,level:Number(level)});
    return existing ? full : `<h${level}${attrs} id="${id}">${body}</h${level}>`;
  });
  return {html,headings};
}
function makeIndex(articles: ArticleRecord[]) {
  const ordered=[...articles].sort((a,b)=>(b.published_at || '').localeCompare(a.published_at || '') || a.slug.localeCompare(b.slug));
  const bySlug=new Map(ordered.map(article=>[article.slug,article]));
  const features=new Map<string,Set<string>>(); const postings=new Map<string,Set<string>>();
  for (const article of ordered) {
    const set=terms(`${article.title} ${article.keywords || ''} ${(article.topic_tags || []).join(' ')}`);features.set(article.slug,set);
    for(const term of set){if(!postings.has(term))postings.set(term,new Set());postings.get(term)!.add(article.slug);}
  }
  const courses=trainingCatalog.filter(training=>training.is_active !== 0).map(training=>({training,terms:terms(training.name)}));
  const relatedCache=new Map<string,{articles:ArticleRecord[];trainings:TrainingRecord[]}>();
  function related(article:ArticleRecord) {
    const cached=relatedCache.get(article.slug);if(cached)return cached;
    const source=features.get(article.slug) || new Set<string>();
    const candidates=new Set<string>();
    // Rare terms first. Bounded candidates avoid all-pairs comparisons as the library grows.
    [...source].sort((a,b)=>(postings.get(a)?.size || 0)-(postings.get(b)?.size || 0)).slice(0,10).forEach(term=>{for(const slug of postings.get(term) || []){if(candidates.size>=500)break;if(slug!==article.slug)candidates.add(slug);}});
    const score=(target:Set<string>)=>[...source].reduce((sum,term)=>sum+(target.has(term)?Math.log(1+articles.length/(postings.get(term)?.size || 1)):0),0);
    const explicit=(article.related_article_slugs || []).filter(slug=>slug!==article.slug && bySlug.has(slug));
    const automatic=[...candidates].map(slug=>({slug,score:score(features.get(slug)!) + (topicFor(bySlug.get(slug)!)===topicFor(article)?1:0)})).filter(row=>row.score>=2).sort((a,b)=>b.score-a.score || a.slug.localeCompare(b.slug)).map(row=>row.slug);
    const selectedArticles=[...new Set([...explicit,...automatic])].slice(0,4).map(slug=>bySlug.get(slug)!);
    const explicitCourses=(article.related_training_slugs || []).map(slug=>trainingCatalog.find(training=>training.slug===slug && training.is_active!==0)).filter((training):training is TrainingRecord=>!!training);
    const ranked=courses.map(row=>({training:row.training,score:score(row.terms)})).filter(row=>row.score>=2).sort((a,b)=>b.score-a.score || a.training.slug.localeCompare(b.training.slug)).map(row=>row.training);
    const selectedCourses=[...new Map([...explicitCourses,...ranked].map(training=>[training.slug,training])).values()].slice(0,2);
    const result={articles:selectedArticles,trainings:selectedCourses};relatedCache.set(article.slug,result);return result;
  }
  return {articles:ordered,bySlug,related,forTopic:(topic:ArticleTopic)=>ordered.filter(article=>topicFor(article)===topic)};
}
let cached: Promise<ReturnType<typeof makeIndex>> | undefined;
export async function getArticleCatalog() {
  const load=async()=>makeIndex((await getCollection('articles')).map(entry=>entry.data));
  if(import.meta.env.DEV)return load();
  return cached ||= load();
}
export function archiveUrl(page:number,topic?:ArticleTopic) { const base=topic?`/artikel/${topic}/`:'/artikel/';return page===1?base:`${base}halaman/${page}/`; }
