const toggle = document.querySelector('.menu-toggle');
const chevron = toggle.querySelector('.chevron');
const menuMobile = document.querySelector('.menu-mobile');
const closeBtn = document.querySelector('.close-btn');

let menuOpen = false;

toggle.addEventListener('click', () => {
    menuOpen = !menuOpen;
    menuMobile.style.display = menuOpen ? 'block' : 'none';
    toggle.classList.toggle('rotate', menuOpen);
});

closeBtn.addEventListener('click', () => {
    menuMobile.style.display = 'none';
    toggle.classList.remove('rotate');
    menuOpen = false;
});

