export function initArticleReader(){
  const body=document.querySelector<HTMLElement>('.ar-prose');
  const progress=document.querySelector<HTMLProgressElement>('.ar-progress');
  const links=[...document.querySelectorAll<HTMLAnchorElement>('.ar-toc a')];
  if(!body)return;
  links.forEach(link=>link.addEventListener('click',event=>{
    const target=document.getElementById(decodeURIComponent(link.hash.slice(1)));
    if(!target)return;
    event.preventDefault();event.stopImmediatePropagation();
    history.pushState(null,'',link.hash);
    target.scrollIntoView({behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'instant':'smooth',block:'start'});
  },{capture:true}));
  const sections=links.map(link=>document.getElementById(decodeURIComponent(link.hash.slice(1)))) .filter((node):node is HTMLElement=>!!node);
  let scheduled=false;
  const update=()=>{
    const rect=body.getBoundingClientRect();const top=100;
    if(progress)progress.value=Math.max(0,Math.min(1,(top-rect.top)/Math.max(1,rect.height-innerHeight+top)));
    const active=[...sections].reverse().find(section=>section.getBoundingClientRect().top<=160);
    links.forEach(link=>{if(active&&decodeURIComponent(link.hash.slice(1))===active.id)link.setAttribute('aria-current','location');else link.removeAttribute('aria-current');});
  };
  addEventListener('scroll',()=>{if(!scheduled){scheduled=true;requestAnimationFrame(()=>{scheduled=false;update();});}},{passive:true});
  addEventListener('resize',update);update();
}
