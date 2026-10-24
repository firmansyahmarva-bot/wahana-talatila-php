export function initDirectories(){
  document.querySelectorAll<HTMLElement>('[data-directory]').forEach(root=>{
    const form=root.querySelector<HTMLFormElement>('form')!;
    const grid=root.querySelector<HTMLElement>('[data-dir-grid]')!;
    const cards=[...grid.children].filter((node):node is HTMLElement=>node instanceof HTMLElement);
    const status=root.querySelector<HTMLElement>('[data-dir-status]')!;
    const more=root.querySelector<HTMLButtonElement>('[data-dir-more]')!;
    const empty=root.querySelector<HTMLElement>('.dir-empty')!;
    let limit=24;
    const field=(name:string)=>form.elements.namedItem(name) as HTMLInputElement|HTMLSelectElement|null;
    const value=(name:string)=>field(name)?.value||'';
    const params=new URLSearchParams(location.search);
    ['q','mode','category','month','sort'].forEach(name=>{
      const input=field(name),initial=params.get(name);if(!input||!initial)return;
      if(input instanceof HTMLSelectElement&&!Array.from(input.options).some(o=>o.value===initial))return;
      input.value=initial;
    });
    const tokens=(text:string)=>text.toLocaleLowerCase('id-ID').normalize('NFKD').split(/\s+/).filter(Boolean);
    const update=(sync=false)=>{
      const query=tokens(value('q')),mode=value('mode'),category=value('category'),month=value('month');
      const filtered=cards.filter(card=>{
        const text=(card.dataset.search||card.textContent||'').toLocaleLowerCase('id-ID').normalize('NFKD');
        const methods=(card.dataset.mode||'').toLowerCase().replace(/in.house/g,'inhouse').split(/[\s,\/|]+/);
        return query.every(term=>text.includes(term))&&(!mode||methods.includes(mode)||(['online','offline'].includes(mode)&&methods.includes('both')))&&(!category||card.dataset.cat===category)&&(!month||card.dataset.month===month);
      });
      if(value('sort')==='name')filtered.sort((a,b)=>(a.dataset.name||a.textContent||'').localeCompare(b.dataset.name||b.textContent||'','id'));
      if(value('sort')==='price')filtered.sort((a,b)=>(Number(a.dataset.price)||Infinity)-(Number(b.dataset.price)||Infinity));
      cards.forEach(card=>{card.hidden=true;});
      filtered.forEach((card,index)=>{card.hidden=index>=limit;grid.append(card);});
      const shown=Math.min(limit,filtered.length);
      status.textContent=`Menampilkan ${shown} dari ${filtered.length} pilihan`;
      empty.hidden=filtered.length>0;more.hidden=shown>=filtered.length;
      if(sync){const url=new URL(location.href);['q','mode','category','month','sort'].forEach(name=>{const current=value(name);if(current&&current!=='default')url.searchParams.set(name,current);else url.searchParams.delete(name);});history.replaceState(null,'',url);}
    };
    form.hidden=false;
    form.addEventListener('submit',event=>{event.preventDefault();limit=24;update(true);});
    form.addEventListener('input',()=>{limit=24;update(true);});
    form.addEventListener('change',()=>{limit=24;update(true);});
    form.addEventListener('reset',()=>{setTimeout(()=>{limit=24;update(true);},0);});
    root.querySelector('[data-dir-reset]')?.addEventListener('click',()=>form.reset());
    more.addEventListener('click',()=>{const before=limit;limit+=24;update();grid.querySelectorAll<HTMLElement>(':scope > :not([hidden])')[before]?.querySelector<HTMLElement>('a,button')?.focus();});
    update();
  });
}
