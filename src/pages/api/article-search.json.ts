import {getArticleCatalog,topicFor} from '../../lib/articles';
export const prerender=true;
export async function GET(){const catalog=await getArticleCatalog();return new Response(JSON.stringify(catalog.articles.map(article=>({slug:article.slug,title:article.title,excerpt:(article.meta_desc||'').slice(0,180),topic:topicFor(article),keywords:article.keywords||''}))),{headers:{'Content-Type':'application/json; charset=utf-8','Cache-Control':'public, max-age=300'}});}
