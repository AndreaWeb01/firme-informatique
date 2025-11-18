// 🎯 Sélection de tous les popups
let loginForm = document.querySelector('.login-form');
let signinForm = document.querySelector('.sigin-form');
let updatePassword = document.querySelector('.update-form');
let carts = document.querySelector('.carts');
let emptyCart = document.querySelector('.empty-cart');

// 🎯 Sélection de tous les boutons
let loginBtn = document.querySelector('#login-btn');
let signinBtn = document.querySelector('#sigin');
let loginFromSignup = document.querySelector('#login-from-signup');
let removePassword = document.querySelector('#removePass');
let renitialise = document.querySelector('#update-pass');
let cartBtn = document.querySelector('#addToCart');
let emptyBtn = document.querySelector('#panier');

// 🔁 Fonction pour tout fermer
function closeAllPopups() {
    loginForm?.classList.remove('active');
    signinForm?.classList.remove('active');
    updatePassword?.classList.remove('active');
    carts?.classList.remove('actives');
    emptyCart?.classList.remove('visible');
}

// 🔁 Clique global pour fermer si on clique en dehors
document.addEventListener('click', (e) => {
    if (
        !loginForm?.contains(e.target) &&
        !signinForm?.contains(e.target) &&
        !updatePassword?.contains(e.target) &&
        !carts?.contains(e.target) &&
        !emptyCart?.contains(e.target) &&
        !e.target.closest('#login-btn, #sigin, #removePass, #update-pass, #login-from-signup, #addToCart, #panier')
    ) {
        closeAllPopups();
    }
});

// 📦 Quand un popup s'ouvre → ferme les autres
function openPopup(element, className = 'active') {
    closeAllPopups(); // Ferme tout avant
    element.classList.add(className); // Ouvre celui demandé
}

// === ⚙️ GESTION DES CLICS SUR LES BOUTONS ===

// ▶️ Connexion
loginBtn?.addEventListener('click', () => {
    openPopup(loginForm);
});

// ▶️ Inscription
signinBtn?.addEventListener('click', () => {
    openPopup(signinForm);
});

// ▶️ Retour vers la connexion depuis l'inscription
loginFromSignup?.addEventListener('click', () => {
    signinForm?.classList.remove('active');
    loginForm?.classList.add('active');
});

// ▶️ Mot de passe oublié
removePassword?.addEventListener('click', () => {
    openPopup(updatePassword);
});

// ▶️ Retour de mot de passe vers connexion
renitialise?.addEventListener('click', () => {
    updatePassword?.classList.remove('active');
    loginForm?.classList.add('active');
});

// ▶️ Panier rempli
cartBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    if (carts.classList.contains('actives')) {
        carts.classList.remove('actives');
    } else {
        closeAllPopups();
        carts.classList.add('actives');
    }
});
carts?.addEventListener('click', (e) => e.stopPropagation());

// ▶️ Panier vide
emptyBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    if (emptyCart.classList.contains('visible')) {
        emptyCart.classList.remove('visible');
    } else {
        closeAllPopups();
        emptyCart.classList.add('visible');
    }
});
emptyCart?.addEventListener('click', (e) => e.stopPropagation());

// (optionnel) Ferme tout au scroll
// window.addEventListener('scroll', closeAllPopups);