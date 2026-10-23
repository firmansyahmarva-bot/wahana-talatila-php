interface SearchArticle {slug:string;title:string;excerpt:string;topic:string;keywords:string;}
const normalize=(value:string)=>value.toLowerCase().normalize('NFKD').replace(/[\u0300-\u036f]/g,'');
export function initArticleSearch(){
  const form=document.querySelector<HTMLFormElement>('.ar-search');
  const input=form?.querySelector<HTMLInputElement>('input');
  const archive=document.querySelector<HTMLElement>('.ar-archive-content');
  const results=document.querySelector<HTMLElement>('.ar-search-results');
  const status=document.querySelector<HTMLElement>('.ar-search-status');
  if(!form||!input||!archive||!results||!status)return;
  let index:Promise<SearchArticle[]>|undefined;
  let generation=0;
  let timer:ReturnType<typeof setTimeout>;
  async function search(){
    const request=++generation;
    const query=input!.value.trim();
    archive!.hidden=!!query;results!.hidden=!query;
    if(!query){status!.textContent='';results!.replaceChildren();return;}
    status!.textContent='Mencari panduan…';
    try{
      index ||= fetch('/api/article-search.json').then(response=>{
        if(!response.ok)throw Error('Search unavailable');
        return response.json();
      }).catch(error=>{index=undefined;throw error;});
      const articles=await index;
      if(request!==generation)return;
      const words=normalize(query).split(/\s+/).filter(Boolean);
      const matches=articles.map(article=>{
        const title=normalize(article.title),all=normalize(article.title+' '+article.keywords+' '+article.excerpt);
        return {article,score:words.every(word=>all.includes(word))?words.reduce((score,word)=>score+(title.includes(word)?3:1),0):0};
      }).filter(row=>row.score>0).sort((a,b)=>b.score-a.score||a.article.slug.localeCompare(b.article.slug));
      results!.replaceChildren();
      let shown=0;
      const more=document.createElement('button');
      more.type='button';more.className='ui-action ar-search-more';more.textContent='Tampilkan lebih banyak';
      const render=()=>{
        more.remove();
        const nodes=matches.slice(shown,shown+24).map(({article})=>{
          const card=document.createElement('article');card.className='ar-search-card';
          const heading=document.createElement('h2'),link=document.createElement('a'),excerpt=document.createElement('p');
          link.href='/artikel/'+article.slug+'/';link.textContent=article.title;
          heading.append(link);excerpt.textContent=article.excerpt;card.append(heading,excerpt);return card;
        });
        shown+=nodes.length;results!.append(...nodes);
        if(shown<matches.length)results!.append(more);
        status!.textContent=matches.length?`${matches.length} panduan ditemukan. Menampilkan ${shown} hasil.`:'Tidak ada hasil. Coba kata kunci lain atau jelajahi topik.';
      };
      more.addEventListener('click',()=>{
        const previous=shown;render();
        results!.querySelectorAll<HTMLAnchorElement>('.ar-search-card a')[previous]?.focus();
      });
      render();
    }catch{
      if(request===generation){status!.textContent='Pencarian belum tersedia. Silakan jelajahi topik dan halaman artikel.';archive!.hidden=false;results!.hidden=true;}
    }
  }
  input.addEventListener('input',()=>{clearTimeout(timer);timer=setTimeout(search,180);});
  form.addEventListener('submit',event=>{event.preventDefault();clearTimeout(timer);search();});
  const initial=new URLSearchParams(location.search).get('q');
  if(initial){input.value=initial;search();}
}
