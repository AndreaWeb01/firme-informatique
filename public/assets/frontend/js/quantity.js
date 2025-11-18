const incremente = document.querySelector('.increment');
const decremente = document.querySelector('.decrement');
const number = document.querySelector('.number');

// const carts = document.querySelector('.carts');
// const emptyCart = document.querySelector('.empty-cart');

let quantity = 1;
number.textContent = quantity; // Affichage initial

// Augmenter la quantité
incremente.addEventListener('click', () => {
    quantity++;
    number.textContent = quantity;
    updateCartDisplay();
});

// Diminuer la quantité
decremente.addEventListener('click', () => {
    if (quantity > 0) {
        quantity--;
        number.textContent = quantity;
        updateCartDisplay();
    }
});

// Met à jour l'affichage du panier selon la quantité
function updateCartDisplay() {
    if (quantity === 0) {
        carts?.classList.remove('actives');
        emptyCart?.classList.add('visible');
    } else {
        emptyCart?.classList.remove('visible');
        carts?.classList.add('actives');
    }
}
