document.addEventListener('DOMContentLoaded', function () {
    const addToCartBtn = document.getElementById('addToCart');
    const panierIcon = document.getElementById('panier');
    const cartsDiv = document.querySelector('.carts');
    const emptyCartDiv = document.querySelector('.empty-cart');
    const wrapDiv = document.querySelector('.wrap');


    // Ajouter un produit au panier (AJAX POST)
    addToCartBtn.addEventListener('click', function () {
        const data = {
            id: this.dataset.id,
            name: this.dataset.name,
            prix: this.dataset.price,
            image: this.dataset.image
        };

        fetch('{{ route("panier.ajouter")}}', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(() => {
            alert('Produit ajouté au panier par ANDREA KOUAKOU !');
            loadCart(); // Recharge visuellement le panier
        });
    });

    // Clic sur l’icône panier → charger depuis la session
    panierIcon.addEventListener('click', function () {
        loadCart();
    });

    // Fonction pour afficher le contenu du panier depuis Laravel
    function loadCart() {
        fetch('{{ route("panier.contenu") }}')
        .then(res => res.json())
        .then(panier => {
            if (panier.length === 0) {
                cartsDiv.style.display = 'none';
                emptyCartDiv.style.display = 'block';
            } else {
                cartsDiv.innerHTML = ''; // Nettoyer avant d'afficher

                panier.forEach(produit => {
                    cartsDiv.innerHTML += `
                    <div class="carts-product">
                        <div class="products-img">
                        <div class="caImgs">
                            <img src="${produit.image}" alt="">
                        </div>
                        </div>
                        <div class="product-name">
                        <h6>${produit.name}</h6>
                        </div>
                        <div class="quantity">
                        <button class="increment">+</button>
                        <span class="number">1</span>
                        <button class="decrement">-</button>
                        </div>
                        <div class="productPrice">
                        <h6>${produit.prix} FCFA</h6>
                        </div>
                    </div>
                    `;
                });

                cartsDiv.style.display = 'block';
                emptyCartDiv.style.display = 'none';
            }

            wrapDiv.style.display = 'block'; // Toujours afficher .wrap
        });
     }
});