/* Restored from the original tools/regulasi-k3.php in origin/main. */

let currentCat = 'all';

function setCategory(cat, btn){
  currentCat = cat;
  document.querySelectorAll('.category-pills .cat-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  filterRegulations();
}

function filterRegulations(){
  const query = document.getElementById('regSearch').value.toLowerCase().trim();
  const cards = document.querySelectorAll('.reg-card');

  cards.forEach(card => {
    const cardCat = card.getAttribute('data-cat');
    const cardText = card.getAttribute('data-text');

    const matchCat = (currentCat === 'all' || cardCat === currentCat);
    const matchQuery = (query === '' || cardText.includes(query));

    if(matchCat && matchQuery){
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}
