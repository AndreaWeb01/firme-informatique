// let carts = document.querySelector('.carts');
// let cartBtn = document.querySelector('#addToCart');

// if (cartBtn && carts) {
//     cartBtn.onclick = (e) => {
//         e.stopPropagation();
//         carts.classList.toggle('actives');
//     };

//     carts.onclick = (e) => {
//         e.stopPropagation();
//     };

//     document.addEventListener('click', () => {
//         if (carts.classList.contains('actives')) {
//             carts.classList.remove('actives');
//         }
//     });

//     // 🔸 Lorsqu'on veut forcer l'ouverture depuis le JS
//     document.addEventListener('popupOpened', () => {
//         carts.classList.add('actives');
//     });
// }