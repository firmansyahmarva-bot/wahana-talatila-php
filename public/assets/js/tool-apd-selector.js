/* Restored from the original tools/apd-selector.php in origin/main. */

function filterApd(cat, btn){
  document.querySelectorAll('.filter-bar .filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const cards = document.querySelectorAll('.apd-card');
  cards.forEach(card => {
    if(cat === 'all' || card.getAttribute('data-cat') === cat){
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}
