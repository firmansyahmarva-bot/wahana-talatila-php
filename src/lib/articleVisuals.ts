import visuals from '../data/article-visuals.json';

/** Topic-specific images and alt text, independent of original article wording. */
export function getArticleVisual(slug: string) {
  return (visuals as Record<string, {src:string;alt:string;title:string;width:number;height:number}>)[slug];
}
