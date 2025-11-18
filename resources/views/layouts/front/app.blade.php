<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1, user-scalable=no">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>@yield('title') - Firme de l'Informatique</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- link swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- police -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- CSS link -->
    <link rel="stylesheet" href="{{ url('assets/frontend/css/style.css') }}">
  </head>
  <body>
    <header id="nav" class="@yield('headerClass', 'headernav')">
      <div class="top-bar">
        <div class="container">
          <div class="container1">
            <span>
              <i class="fas fa-phone icone-hide"></i> 
              <span class="number-hide">+225 27 24 36 11 97 / +225 07 07 49 47 72</span>
              <i class="fas fa-map-marker-alt ms-4 mobile-hide"></i> 
              <span class="adresse-hide">Angré Nouveau Chu</span>
            </span>
          </div>   
          <div class="container2">
            <span class="">
              <a href="#" class="text-white me-3" id="login-btn">Se connecter</a>
            </span>
            <span>
              <a href="{{ route('contact') }}#devis" class="text-white text-decoration-none devis-hide">Demander un devis</a>
            </span>
          </div>        
        </div>
      </div>

      <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between">
          <a class="navbar-brand" href="#">
            <img src="{{ url('assets/frontend/image/FID.jpg') }}" alt="Logo" width="100">
          </a>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link {{ Route::is('accueil','cablage','maintenance','installationcamera') ? 'active' : '' }}" href="{{ route('accueil') }}">ACCUEIL</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('boutique','accessoiresmaterielinfo','materielinfo') ? 'active' : '' }}" href="{{ route('boutique') }}">BOUTIQUE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">A PROPOS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('conseils','conseils.show') ? 'active' : '' }}" href="{{ route('conseils') }}">CONSEILS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">CONTACT</a>
              </li>
            </ul>
          </div>
          <div class="d-flex align-items-center">
            <!-- Icônes -->
            <div class="d-flex align-items-center search-cart">
              <!-- Formulaire visible que sur grands écrans -->
              <div class="search-box d-none d-lg-flex align-items-center">
                <input type="text" placeholder="">
                <span class="separator">|</span>
                <i class="fas fa-search search-icon"></i>
              </div>
              <!-- Panier (toujours visible) -->
              <div class="cart me-2" id="panier">
                  <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
            <!-- Burger menu -->
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div>
      </nav> 

      <div class="wrap">

        @yield('banner')
      
      </div>


    <form action="" class="login-form">
      <div class="titles">
        <h1>connexion</h1>
      </div>
      <div class="erreur">
        <input type="text" placeholder="Entrer votre email ou numero de téléphone" class="box">
      </div>
      <div class="erreur">
        <input type="password" placeholder="Entrer votre mot de passe " class="box">
      </div>

      <button class="btn">Se connecter</button>
        <div class="authentication">
          <p>Un nouveau client ? <a id="sigin">S'inscrire.</a></p>
          <p>mot de passe oublié ? <a href="#" id="removePass">Rénitialisé</a></p>
        </div>
    </form>
    <form action="" class="update-form">
      <div class="titless">
        <h1>mot de passe oublié</h1>
      </div>
      <div class="erreur">
        <input type="email" placeholder="Entrer votre email" class="box">
      </div>
      <button class="btn-password">recupérer</button>
      <div class="authentication">
        <p>je me souviens de mon mot de passe, <a id="update-pass">Se connecter.</a></p>
      </div>
    </form>
    <form action="" class="sigin-form">
      <div class="titles">
        <h1>Inscription</h1>
      </div>
      <div class="erreur">
        <input type="text" placeholder="Entrer votre nom" class="box">
      </div>
      <div class="erreur">
        <input type="text" placeholder="Entrer votre prenom" class="box">
      </div>
      <div class="erreur">
        <input type="email" placeholder="Entrer votre email " class="box">
      </div>
      <div class="erreur">
        <input type="tel" placeholder="Entrer numero de téléphone" class="box">
      </div>
      <div class="erreur">
        <input type="password" placeholder="Entrer votre mot de passe " class="box">
      </div>

      <button class="btn-inscription">S'inscrire</button>
        <div class="authentication">
          <p>Un nouveau client ? <a id="login-from-signup">Se connecter.</a></p>
        </div>
    </form>
  </header>

      <div class="wrap">

          <!-- Popup panier -->
          <div class="carts" style="display: none;">
            
          </div>

          <!-- Si panier vide -->
          <div class="empty-cart" style="display: none;">
              <i class="fas fa-sad-tear"></i>
              <h5>Votre panier est vide !</h5>
          </div>

      </div>


      @yield('content')

      <a href="#" class="back-to-top" id="backToTop">&#8679;</a>
      <footer>
        <div class="wraps">
          <div class="contenus">
            <div class="contenu1">
              <div class="logoF">
                <a href="{{ route('accueil') }}"><img src="{{ url('assets/frontend/image/FID 2.png') }}" alt="logo fid blanc"></a>
              </div>
              <div class="end1">
                <a style="text-decoration: none; color:white;" href="https://www.facebook.com/p/FIRME-de-lInformatique-61554997681433/?locale=fr_FR" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                <!-- <i class="fab fa-linkedin linkedin-icon"></i> -->
                <a style="text-decoration: none; color:white;" href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                <!-- <i class="fab fa-tiktok"></i> -->
                {{-- <i class="fab fa-youtube"></i> --}}
              </div>
            </div>  
            <div class="menu">
              <h1>SERVICES</h1>
              <p>Fourniture de consommables et accessoires informatique</p>
              <p>Fourniture dE  MATERIELs informatique</p>
              <p>Fourniture de sOLUTIONS informatique</p>
              <p>ENTRETIEN ET MAINTENACE DE MATERIELS INFORMATIQUE</p>
              <p>TRAVAUX DE CÂBLAGES RESEAUX INFORMATIQUES ET TELEPHONIQUES</p>
            </div>
            <div class="info1">
              <h1>Contact</h1>
              <div class="lieu">
                  <i class="fas fa-map-marker-alt me-1"></i>
                  <p>Angré Nouveau CHU</p>
              </div>
              <div class="lieu">
                  <i class="fas fa-envelope me-1"></i>
                  <p>contact@firme-informatique.com</p>
              </div>
              <div class="lieu">
                  <i class="fas fa-phone"></i>
                  <p>+225 01 01 73 50 02</p>
              </div>
            </div>
          </div>
          <p class="copy" style="padding-bottom: 3rem; margin-top: 2rem; text-align: center; color: white;"> &copy; Conçu par <a href="https://attouco.com/" style="text-decoration: none; color: white;">FIRME ATTOU & CO</a></p>        
        </div>
      </footer>

      <script>
      
        document.addEventListener('DOMContentLoaded', function () {
          const addToCartBtn = document.getElementById('addToCart');
          const panierIcon = document.getElementById('panier');
          const cartsDiv = document.querySelector('.carts');
          const emptyCartDiv = document.querySelector('.empty-cart');
          const wrapDiv = document.querySelector('.wrap');

          
          // Ajouter un produit au panier
          if (addToCartBtn) {
              addToCartBtn.addEventListener('click', function () {
                  const data = {
                      id: this.dataset.id,
                      name: this.dataset.name,
                      prix: this.dataset.price,
                      image: this.dataset.image
                  };

                  fetch("{{ route('panier.ajouter') }}", {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json',
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                      body: JSON.stringify(data)
                  })
                  .then(res => res.json())
                  .then(() => {
                      // alert('Produit ajouté au panier !');
                      loadCart();
                  });
              });
          }

          // Cliquer sur l’icône panier
          if (panierIcon) {
              panierIcon.addEventListener('click', loadCart);
          }

          // Charger le mini-panier
          function loadCart() {
              fetch("{{ route('panier.contenu') }}")
              .then(res => res.json())
              .then(panier => {
                  if (!cartsDiv || !emptyCartDiv || !wrapDiv) return;

                  if (panier.length === 0) {
                      cartsDiv.style.display = 'none';
                      emptyCartDiv.style.display = 'block';
                  } else {
                      cartsDiv.innerHTML = '';
                      let total = 0;

                      panier.forEach(produit => {
                        // console.log(produit); 

                          const quantity = produit.quantity || 1;
                          total += parseFloat(produit.prix) * quantity;

                          

                          cartsDiv.innerHTML += `
                              <div class="carts-product" data-id="${produit.id}" data-price="${produit.prix}">
                                  <div class="products-img">
                                      <div class="caImgs">
                                          <img src="${produit.image}" alt="">
                                      </div>
                                  </div>
                                  <div class="product-name">
                                      <h6>${produit.name}</h6>
                                  </div>
                                  <div class="quantity">
                                      <button class="decrement">-</button>
                                      <span class="number">${quantity}</span>
                                      <button class="increment">+</button>
                                  </div>
                              </div>
                          `;
                      });

                      cartsDiv.innerHTML += `
                          <div class="totalproducts">
                              <div class="total"><h6>Total</h6></div>
                              <div class="productPrice"><h6 id="totalAmount">${total.toLocaleString()} FCFA</h6></div>
                          </div>
                          <div class="action">
                              <div class="gotocart"><a href="{{ route('panier.afficher') }}">Aller au panier</a></div>
                              <div class="gotobuy"><a href="#">Payer maintenant</a></div>
                          </div>
                      `;

                      cartsDiv.style.display = 'block';
                      emptyCartDiv.style.display = 'none';
                      addQuantityEvents();

                      // Ajouter événement pour le bouton "Payer maintenant"
                      
                  }

                  wrapDiv.style.display = 'block';
              });
          }

          // Gérer les boutons + et -
          function addQuantityEvents() {
              const products = document.querySelectorAll('.carts-product');

              products.forEach(product => {
                  const incrementBtn = product.querySelector('.increment');
                  const decrementBtn = product.querySelector('.decrement');
                  const numberSpan = product.querySelector('.number');
                  const productId = product.dataset.id;

                  if (incrementBtn) {
                    incrementBtn.addEventListener('click', () => {
                    let quantity = parseInt(numberSpan.textContent);
                    quantity++;
                    numberSpan.textContent = quantity;
                    updateQuantityOnServer(productId, quantity);
                    updateTotal();
                  });
                  }
                  

                  if (decrementBtn) {
                    decrementBtn.addEventListener('click', () => {
                      let quantity = parseInt(numberSpan.textContent);
                      if (quantity > 1) {
                          quantity--;
                          numberSpan.textContent = quantity;
                          updateQuantityOnServer(productId, quantity);
                          updateTotal();
                      }
                  });
                  }
                  
              });
          }

          function updateQuantityOnServer(productId, quantity) {
            // console.log(`Updating ${productId} to quantity ${quantity}`);
            fetch("{{ route('panier.majpanier') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: productId, quantity })
            });
          }


          // Mettre à jour le total
          function updateTotal() {
              const products = document.querySelectorAll('.carts-product');
              let total = 0;

              products.forEach(product => {
                  const quantity = parseInt(product.querySelector('.number').textContent);
                  const price = parseFloat(product.dataset.price);
                  total += quantity * price;
              });

              const totalAmount = document.getElementById('totalAmount');
              if (totalAmount) {
                  totalAmount.textContent = `${total.toLocaleString()} FCFA`;
              }
          }


          // ============================
          //   Script pour detail-panier
          // ============================
          const panierTableBody = document.querySelector('#panierTableBody');
          const totalDisplay = document.getElementById('cartTotal');


          if (panierTableBody) {
        fetch("{{ route('panier.contenu') }}")
        .then(res => res.json())
        .then(panier => {
            panierTableBody.innerHTML = '';
            let total = 0;

            panier.forEach(produit => {
                const quantity = produit.quantity || 1;
                const price = parseFloat(produit.prix);
                const produitTotal = quantity * price;
                total += produitTotal;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="carts-product" data-id="${produit.id}">
                            <div class="products-img">
                                <div class="caImgs">
                                    <img src="${produit.image}" alt="" />
                                </div>
                            </div>
                            <div class="product-name">
                                <h6>${produit.name}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="productPrice">
                            <h6 class="item-price" data-price="${price}">${price.toLocaleString()} FCFA</h6>
                        </div>
                    </td>
                    <td>
                        <div class="quantity">
                            <button class="decrement">-</button>
                            <span class="number">${quantity}</span>
                            <button class="increment">+</button>
                        </div>
                    </td>
                    <td>
                        <i class="fas fa-times delete-icon" style="cursor: pointer; color: red;"></i>
                    </td>
                `;
                panierTableBody.appendChild(row);

                const numberSpan = row.querySelector('.number');
                const incrementBtn = row.querySelector('.increment');
                const decrementBtn = row.querySelector('.decrement');
                const deleteIcon = row.querySelector('.delete-icon');

                if (incrementBtn && numberSpan) {
                  incrementBtn.addEventListener('click', () => {
                    let qty = parseInt(numberSpan.textContent);
                    qty++;
                    numberSpan.textContent = qty;
                    updateQuantityOnServer(produit.id, qty);
                    updateTotalTable();
                });
                }
                

                if (decrementBtn && numberSpan) {
                  decrementBtn.addEventListener('click', () => {
                    let qty = parseInt(numberSpan.textContent);
                    if (qty > 1) {
                        qty--;
                        numberSpan.textContent = qty;
                        updateQuantityOnServer(produit.id, qty);
                        updateTotalTable();
                    }
                  });
                }
                

                if (deleteIcon) {
                  deleteIcon.addEventListener('click', () => {
                    fetch("{{ route('panier.supprimer') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: produit.id })
                    }).then(() => {
                        row.remove();
                        updateTotalTable();
                    });
                });
                }
                
            });

            updateTotalTable();
        });
    }


    function updateTotalTable() {
        const rows = document.querySelectorAll('#panierTableBody tr');
        let total = 0;

        rows.forEach(row => {
            const price = parseFloat(row.querySelector('.item-price').dataset.price);
            const qty = parseInt(row.querySelector('.number').textContent);
            total += price * qty;
        });

        if (totalDisplay) {
            totalDisplay.textContent = `${total.toLocaleString()} FCFA`;
        }
    }


    // ----------- Script pour la page résumé facture (ne s’exécute que si .cart-form existe) -----------

  const cartForm = document.querySelector('.cart-form');
  if (cartForm) {
    fetch("{{ route('panier.contenu') }}")
      .then(res => res.json())
      .then(panier => {
        cartForm.innerHTML = '<h5>Resumé de votre facture</h5>';
        let total = 0;

        panier.forEach(produit => {
          const quantity = produit.quantity || 1;
          const price = parseFloat(produit.prix);
          const totalProduit = quantity * price;
          total += totalProduit;

          cartForm.innerHTML += `
            <div class="carts-form mb-3">
              <div class="products-img">
                <div class="caImgs">
                  <img src="${produit.image}" alt="${produit.name}">
                </div>
              </div>

              <div class="product-name">
                <h6>${produit.name} (${quantity}x)</h6>
              </div>
              <div class="productPrice">
                <h6>${totalProduit.toLocaleString()} Fcfa</h6>
              </div>
            </div>
          `;
        });

        cartForm.innerHTML += `
          <div class="totalproduct">
            <div class="total">
              <h6 style="text-transform: uppercase;">Total</h6>
            </div>
            <div class="productPrice">
              <h6>${total.toLocaleString()} Fcfa</h6>
            </div>
          </div>

          <div class="confidentialite mt-5">
            <div class="retour">
              <a href="politique.html">Politique de retour</a>
            </div>
            <div class="confi">
              <a href="confidentialite.html">Politique de confidentialite</a>
            </div>
            <div class="use">
              <a href="terme.html">Condition d'utilisation</a>
            </div>
          </div>
        `;
      });
    }
  });

      </script>
      

      <script src="{{ url('assets/frontend/js/back.js') }}"></script>
      <script src="{{ url('assets/frontend/js/counter.js') }}"></script>
      <script src="{{ url('assets/frontend/js/connect.js') }}"></script>
      {{-- <script src="{{ url('assets/frontend/js/panier.js') }}"></script> --}}
      <script src="{{ url('assets/frontend/js/category.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></sc>
      <script src="{{ url('assets/frontend/js/swiper.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>