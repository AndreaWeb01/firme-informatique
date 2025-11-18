const categories = document.querySelectorAll('.categorie-item');

categories.forEach(item => {
  item.addEventListener('click', () => {
    categories.forEach(el => el.classList.remove('active')); // enlever le style des autres
    item.classList.add('active'); // ajouter à l’élément cliqué
  });
});
