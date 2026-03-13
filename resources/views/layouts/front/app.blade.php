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
      <div class="hero">
        <div>
      <div class="fixed-top mt-3">
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
              @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-link text-white me-3" id="login-btn">Se déconnecter</button>
                </form>
                <a href="{{ route('dashboard') }}" class="text-white me-3" id="login-btn">Tableau de bord</a>
              @else
                <a href="#" class="text-white me-3" id="login-btn">Se connecter</a>
              @endif
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
              <div class="search-box d-none d-lg-flex align-items-center" style="position:relative;">
                  <input type="text" id="searchInput" placeholder="Rechercher...">
                  <span class="separator">|</span>
                  <i class="fas fa-search search-icon"></i>

                  <!-- Zone des suggestions -->
                  <div id="suggestionsBox"
                      style="position:absolute; top:40px; left:0; width:100%; background:white;
                              border:1px solid #ddd; display:none; z-index:999;">
                  </div>
              </div>
                    <script>
            const routes = {
              produit: "{{ route('produit.description', ['slug' => ':slug', 'id' => ':id']) }}",
              conseil: "{{ route('conseils.show', ':slug') }}"
          };
                </script>


              <!-- Panier (toujours visible) -->
              <div class="cart me-2" id="panier" style="cursor: pointer">
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
      </div>

      <div class="wrap">

        @yield('banner')

      </div>
      </div>

      </div>


    <form action="{{ route('login') }}" method="POST" class="login-form">
      @csrf
      <div class="titles">
        <h1>connexion</h1>
      </div>
      @if($errors->has('email') || $errors->has('password'))
        <div class="alert alert-danger mb-2 py-2 small">{{ $errors->first('email') ?: $errors->first('password') }}</div>
      @endif
      <div class="erreur">
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Entrer votre email" class="box" required autocomplete="username">
      </div>
      <div class="erreur">
        <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" class="box" required autocomplete="current-password">
      </div>

      <button class="btn" type="submit">Se connecter</button>
        <div class="authentication">
          <p >Un nouveau client ? <a id="sigin" style="cursor: pointer">S'inscrire.</a></p>
          <p>mot de passe oublié ? <a href="#" id="removePass" style="cursor: pointer">Rénitialisé</a></p>
        </div>
    </form>


    <form action="{{ route('password.email') }}" method="POST" class="update-form">
      @csrf
      <div class="titless">
        <h1>Mot de passe oublié</h1>
      </div>
      @if(session('status'))
        <div class="alert alert-success mb-2 py-2 small">{{ session('status') }}</div>
      @endif
      @error('email')
        <div class="alert alert-danger mb-2 py-2 small">{{ $message }}</div>
      @enderror
      <div class="erreur">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre email" class="box" required>
      </div>
      <button class="btn-password" type="submit">recupérer</button>
      <div class="authentication">
        <p>je me souviens de mon mot de passe, <a id="update-pass" style="cursor: pointer">Se connecter.</a></p>
      </div>
    </form>

    <form action="{{ route('register') }}" method="POST" class="sigin-form">
      @csrf
      <div class="titles">
        <h1>Inscription client</h1>
      </div>
      @if($errors->any())
        <div class="alert alert-danger mb-2 py-2 small">
          <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
          </ul>
        </div>
      @endif
      <div class="erreur">
        <input type="text" name="name" id="signup-name" value="{{ old('name') }}" placeholder="Entrer votre nom" class="box" required>
      </div>
      <div class="erreur">
        <input type="text" name="firstname" id="signup-firstname" value="{{ old('firstname') }}" placeholder="Entrer votre prénom" class="box" required>
      </div>
      <div class="erreur">
        <input type="email" name="email" id="signup-email" value="{{ old('email') }}" placeholder="Entrer votre email" class="box" required>
      </div>
      <div class="erreur">
        <input type="tel" name="telephone" id="signup-telephone" value="{{ old('telephone') }}" placeholder="Numéro de téléphone (optionnel)" class="box">
      </div>
      <div class="erreur">
        <input type="password" name="password" id="signup-password" placeholder="Mot de passe (min. 8 caractères)" class="box" required minlength="8" autocomplete="new-password">
      </div>
      <div class="erreur">
        <input type="password" name="password_confirmation" id="signup-password-confirmation" placeholder="Confirmer votre mot de passe" class="box" required autocomplete="new-password">
      </div>
      <button class="btn-inscription" type="submit">S'inscrire</button>
        <div class="authentication">
          <p>Déjà client ? <a id="login-from-signup" style="cursor: pointer">Se connecter.</a></p>
        </div>
    </form>


  </header>

      <div class="wrap">

          <!-- Popup panier -->
          <div class="carts mt-4 " style="display: none; z-index: 1000; margin-top: 10px;">

          </div>

          <!-- Si panier vide -->
          <div class="empty-cart mt-4" style="display: none; margin-top: 10px; z-index: 1000">
              <button type="button" class="empty-cart-close" aria-label="Fermer">
                  <i class="fas fa-times" style="font-size: 20px; cursor: pointer; margin-right: 7px;"></i>
              </button>
              <i class="fas fa-sad-tear"></i>
              <h5>Votre panier est vide !</h5>
          </div>

      </div>


      @yield('content')

      <a href="#" class="back-to-top" id="backToTop">&#8679;</a>
      <footer>
        <div class="wraps">
          <div class="footer-grid">

            {{-- Colonne 1 : Logo --}}
            <div class="footer-col footer-logo-col">
              <a href="{{ route('accueil') }}">
                <img src="{{ url('assets/frontend/image/FID 2.png') }}" alt="logo fid blanc">
              </a>
              <div class="footer-social">
                <a href="https://www.facebook.com/p/FIRME-de-lInformatique-61554997681433/?locale=fr_FR" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
              </div>
            </div>

            {{-- Colonne 2 : Services --}}
            <div class="footer-col footer-services-col">
              <h2>Services</h2>
              <ul>
                <li>Fourniture de consommables et accessoires informatique</li>
                <li>Fourniture de matériels informatique</li>
                <li>Fourniture de solutions informatique</li>
                <li>Entretien et maintenance de matériels informatique</li>
                <li>Travaux de câblages réseaux informatiques et téléphoniques</li>
              </ul>
            </div>

            {{-- Colonne 3 : Contact --}}
            <div class="footer-col footer-contact-col">
              <h2>Contact</h2>
              <div class="footer-contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Angré Nouveau CHU</span>
              </div>
              <div class="footer-contact-item">
                <i class="fas fa-envelope"></i>
                <span>contact@firme-informatique.com</span>
              </div>
              <div class="footer-contact-item">
                <i class="fas fa-phone"></i>
                <span>+225 01 01 73 50 02</span>
              </div>
            </div>

          </div>
          <p class="footer-copy">&copy; Conçu par <a href="https://attouco.com/">FIRME ATTOU & CO</a></p>
        </div>
      </footer>

      <script>

        document.addEventListener('DOMContentLoaded', function () {
          const addToCartBtn = document.getElementById('addToCart');
          const panierIcon = document.getElementById('panier');
          const cartsDiv = document.querySelector('.carts');
          const emptyCartDiv = document.querySelector('.empty-cart');
          const emptyCartCloseBtn = document.querySelector('.empty-cart-close');
          const wrapDiv = document.querySelector('.wrap');


          // Ajouter un produit au panier (bouton unique pour page description)
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
                  .then((data) => {
                      if (data && data.success === false) {
                          alert(data.message || 'Stock insuffisant.');
                          return;
                      }
                      loadCart();
                  });
              });
          }

          // Ajouter un produit au panier (tous les boutons de la liste des produits)
          // Utilisation de la délégation d'événements pour les éléments chargés dynamiquement
          document.addEventListener('click', function(e) {
              const addToCartBtn = e.target.closest('.add-to-cart-btn');
              if (addToCartBtn) {
                  e.preventDefault();
                  e.stopPropagation();

                  const data = {
                      id: addToCartBtn.dataset.id,
                      name: addToCartBtn.dataset.name,
                      prix: addToCartBtn.dataset.price,
                      image: addToCartBtn.dataset.image
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
                  .then((data) => {
                      if (data && data.success === false) {
                          alert(data.message || 'Stock insuffisant.');
                          return;
                      }
                      loadCart();
                  })
                  .catch(error => {
                      console.error('Erreur lors de l\'ajout au panier:', error);
                  });
              }
          });

          // Cliquer sur l’icône panier (toggle ouvrir/fermer)
          if (panierIcon) {
              panierIcon.addEventListener('click', function () {
                  if (!cartsDiv || !emptyCartDiv) return;

                  const cartVisible = cartsDiv.style.display === 'block';
                  const emptyVisible = emptyCartDiv.style.display === 'block';

                  // Si l'un des deux (panier plein ou panier vide) est visible, on le masque
                  if (cartVisible || emptyVisible) {
                      cartsDiv.style.display = 'none';
                      emptyCartDiv.style.display = 'none';
                      return;
                  }

                  // Sinon, on charge/affiche le mini-panier
                  loadCart();
              });
          }

          // Fermer le popup panier vide en cliquant sur le bouton "Fermer"
          if (emptyCartCloseBtn) {
              emptyCartCloseBtn.addEventListener('click', function () {
                  if (!emptyCartDiv || !cartsDiv) return;
                  emptyCartDiv.style.display = 'none';
                  cartsDiv.style.display = 'none';
              });
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
                                  <div class="remove">
                                      <i class="fas fa-times delete-icon" style="cursor: pointer; color: red;"></i>
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
                              <div class="gotobuy"><a href="{{ route('confirm.payment') }}">payer maintenant</a></div>
                          </div>
                      `;

                      cartsDiv.style.display = 'block';
                      emptyCartDiv.style.display = 'none';
                      addQuantityEvents();

                      // Faire apparaître directement le popup panier à l'écran
                      cartsDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
                  const deleteIcon = product.querySelector('.delete-icon');

                  if (incrementBtn) {
                    incrementBtn.addEventListener('click', () => {
                    let quantity = parseInt(numberSpan.textContent);
                    quantity++;
                    updateQuantityOnServer(productId, quantity).then((data) => {
                      if (data && data.success === false) {
                        alert(data.message || 'Stock insuffisant.');
                      }
                      if (data && typeof data.quantity !== 'undefined') {
                        numberSpan.textContent = data.quantity;
                      } else {
                        numberSpan.textContent = quantity;
                      }
                      updateTotal();
                    });
                  });
                  }


                  if (decrementBtn) {
                    decrementBtn.addEventListener('click', () => {
                      let quantity = parseInt(numberSpan.textContent);
                      if (quantity > 1) {
                          quantity--;
                          updateQuantityOnServer(productId, quantity).then((data) => {
                            if (data && data.success === false) {
                              alert(data.message || 'Stock insuffisant.');
                            }
                            if (data && typeof data.quantity !== 'undefined') {
                              numberSpan.textContent = data.quantity;
                            } else {
                              numberSpan.textContent = quantity;
                            }
                            updateTotal();
                          });
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
                              body: JSON.stringify({ id: productId })
                          }).then(() => {
                              // Recharger le contenu du mini-panier après suppression
                              loadCart();
                          });
                      });
                  }

              });
          }

          function updateQuantityOnServer(productId, quantity) {
            return fetch("{{ route('panier.majpanier') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: productId, quantity })
            }).then(res => res.json());
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
                    updateQuantityOnServer(produit.id, qty).then((data) => {
                      if (data && data.success === false) {
                        alert(data.message || 'Stock insuffisant.');
                      }
                      if (data && typeof data.quantity !== 'undefined') {
                        numberSpan.textContent = data.quantity;
                      } else {
                        numberSpan.textContent = qty;
                      }
                      updateTotalTable();
                    });
                });
                }


                if (decrementBtn && numberSpan) {
                  decrementBtn.addEventListener('click', () => {
                    let qty = parseInt(numberSpan.textContent);
                    if (qty > 1) {
                        qty--;
                        updateQuantityOnServer(produit.id, qty).then((data) => {
                          if (data && data.success === false) {
                            alert(data.message || 'Stock insuffisant.');
                          }
                          if (data && typeof data.quantity !== 'undefined') {
                            numberSpan.textContent = data.quantity;
                          } else {
                            numberSpan.textContent = qty;
                          }
                          updateTotalTable();
                        });
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
<script>
const searchInput = document.getElementById('searchInput');
const searchIcon = document.querySelector('.search-icon');

function runSearch() {
    if (!searchInput) return;

    let query = searchInput.value.trim();

    if (query.length === 0) {
        return;
    }

    // Redirige vers la page boutique avec le terme de recherche
    window.location.href = "{{ route('boutique') }}" + "?q=" + encodeURIComponent(query);
}

if (searchInput) {
    // Valider la recherche avec la touche Entrée
    searchInput.addEventListener('keyup', function (e) {
        if (e.key === 'Enter') {
            runSearch();
        }
    });
}

if (searchIcon) {
    // Valider la recherche au clic sur l'icône
    searchIcon.addEventListener('click', function () {
        runSearch();
    });
}
</script>







      <script src="{{ url('assets/frontend/js/back.js') }}"></script>
      <script src="{{ url('assets/frontend/js/counter.js') }}"></script>
      <script src="{{ url('assets/frontend/js/connect.js') }}"></script>
      {{-- <script src="{{ url('assets/frontend/js/panier.js') }}"></script> --}}
      <script src="{{ url('assets/frontend/js/category.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
      <script src="{{ url('assets/frontend/js/swiper.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
