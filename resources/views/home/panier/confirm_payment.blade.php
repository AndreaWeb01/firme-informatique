@extends("layouts.front.app")

@section('title', 'Confirmer Paiement')

@section('banner')

<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Commencer vos achats</a>
    </div>
</div>

@endsection

@section("content")

<main class="main-confirm-payment">

        <section class="container">
           <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / <a href="{{ route('boutique') }}">Boutique</a> / Paiement</p>
            <div class="paie">
                <div class="pay-form">
                    <form action="{{ route('commande.valider') }}" method="POST" id="confirm-payment-form">
                        @csrf
                        <input type="hidden" name="type_commande" id="type-commande" value="">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="margin-bottom: 15px;">
                                <ul style="margin: 0; padding-left: 18px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="contacts-form">
                            <div class="inform-contact">
                                <div class="bloc1">
                                    <h5>Contact</h5>
                                </div>
                                <div class="bloc2">
                                    <a href="connectPage.html">Suivre ma commande</a>
                                </div>
                            </div>

                            <div class="erreur">
                                <input type="tel" name="contact" placeholder="Entrer votre contact" class="box" required>
                            </div>
                        </div>

                       

                        <div class="livraison-adresse mt-4">
                            <h5  style="margin-bottom: 15px;">Adresse de livraison</h5>
                            <div class="presentation">
                                <div class="erreurs">
                                    <input type="text"  name="nom" placeholder="Entrer votre nom" class="box" required>
                                </div>
                                <div class="erreurs">
                                    <input type="text" name="prenom" placeholder="Entrer votre prenom" class="box" required>
                                </div>
                            </div>
                            <div class="erreur">
                                <input type="email" name="email" placeholder="Entrer votre email " class="box" required>
                            </div>
                            <div class="erreur">
                                <input type="tel" name="numero" placeholder="Entrer numero de téléphone" class="box" required>
                            </div>
                            <div class="erreur">
                                <input type="text" name="adresse_livraison" placeholder="Entrer votre adresse de livraison" class="box" required>
                            </div>
                            <div class="erreur">
                                <input type="text" name="ville" placeholder="Entrer votre ville" class="box" required>
                            </div>
                            <div class="erreur">
                                <input type="text" name="notes" placeholder="Notes supplémentaires (optionnel)" class="box">
                            </div>
                        </div>

                        <button type="submit" class="btn-paye" id="confirm-pay-btn" disabled>Confirmer votre paiement</button>
                    </form>
                    {{-- <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var form = document.querySelector('form[action="{{ route('commande.valider') }}"]');
                            var btn = document.getElementById('confirm-pay-btn');
                            if (form && btn) {
                                form.addEventListener('submit', function() {
                                    btn.disabled = true;
                                    btn.textContent = 'Redirection en cours…';
                                });
                            }
                        });
                    </script> --}}
                </div>
                <div class="cart-form">
                    <h5>Resumé de votre facture</h5>
                    <div class="carts-form mb-3">
                        <div class="products-img">
                            <div class="caImgs">
                                <img src="image/ordi2.png" alt="">
                            </div>
                        </div>
                        <div class="product-name">
                            <h6>HP EliteBook X360 1040 G8 Core i7 -1185G7 _ 3.00 GHz, Tactile Pliable, 1 Tera SSD, 16 Go Ram</h6>
                        </div>
                        <div class="productPrice">
                            <h6>289 000 Fcfa</h6>
                        </div>
                    </div>


                    <div class="totalproduct">
                        <div class="total">
                            <h6 style="text-transform: uppercase;">Total</h6>
                        </div>
                        <div class="productPrice">
                            <h6>289 000 Fcfa</h6>
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
                </div>
            </div>
           </div>
        </section>











        {{-- Modal choix de paiement --}}
        <div id="payment-choice-modal" class="payment-modal" style="display:none; position:fixed; inset:0; z-index:9999;">
            <div class="payment-modal-backdrop" style="position:absolute; inset:0; background:rgba(15,23,42,0.6);"></div>

            <div class="payment-modal-content"
                 style="
                    position:relative;
                    max-width:420px;
                    margin:80px auto;
                    background:#ffffff;
                    border-radius:16px;
                    padding:24px 24px 20px;
                    box-shadow:0 20px 40px rgba(15,23,42,0.35);
                    display:flex;
                    flex-direction:column;
                    gap:12px;
                 ">

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="
                            width:32px;
                            height:32px;
                            border-radius:999px;
                            background:rgba(250,204,21,0.12);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:#f59e0b;
                            font-size:18px;
                            ">
                            !
                        </span>
                        <h5 style="margin:0; font-size:18px; font-weight:600; color:#0f172a;">
                            Choisissez votre mode de paiement
                        </h5>
                    </div>
                    <button type="button"
                            aria-label="Fermer"
                            style="
                                border:none;
                                background:transparent;
                                font-size:20px;
                                line-height:1;
                                cursor:pointer;
                                color:#9ca3af;
                            "
                            onclick="document.getElementById('payment-choice-modal').style.display='none'">
                        ×
                    </button>
                </div>

                <p style="margin:0 0 12px; font-size:14px; line-height:1.5; color:#6b7280;">
                    Comment souhaitez-vous finaliser cette commande ?
                </p>

                <div class="payment-modal-actions"
                     style="display:flex; flex-direction:column; gap:10px; margin-top:8px;">

                    <button type="button" id="btn-paiement-direct"
                            class="btn-paye"
                            style="
                                width:100%;
                                justify-content:space-between;
                                background:#f3f4f6;
                                color:#111827;
                                border-radius:999px;
                                border:1px solid #e5e7eb;
                                display:flex;
                                align-items:center;
                                padding:10px 16px;
                                font-size:14px;
                                font-weight:500;
                            ">
                        <span style="display:flex; flex-direction:column; text-align:left;">
                            <span style="font-weight:600;">Paiement direct</span>
                            <span style="font-size:12px; color:#6b7280;">Redirection vers le paiement sécurisé</span>
                        </span>
                        <span style="font-size:16px; color:#9ca3af;">→</span>
                    </button>

                    <button type="button" id="btn-paiement-livraison"
                            class="btn-paye"
                            style="
                                width:100%;
                                justify-content:space-between;
                                background:#facc15;
                                color:#111827;
                                border-radius:999px;
                                border:1px solid #eab308;
                                display:flex;
                                align-items:center;
                                padding:10px 16px;
                                font-size:14px;
                                font-weight:600;
                            ">
                        <span style="display:flex; flex-direction:column; text-align:left;">
                            <span>Paiement à la livraison</span>
                            <span style="font-size:12px; color:#713f12;">Votre commande sera mise en attente</span>
                        </span>
                        <span style="font-size:16px;">✓</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- produits récemment vus --}}
        @include('home.partials.recently_viewed')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var confirmBtn = document.getElementById('confirm-pay-btn');
            var form = document.getElementById('confirm-payment-form');
            var modal = document.getElementById('payment-choice-modal');
            var btnPaiementDirect = document.getElementById('btn-paiement-direct');
            var btnPaiementLivraison = document.getElementById('btn-paiement-livraison');
            var hiddenTypeCommande = document.getElementById('type-commande');

            if (!confirmBtn || !form || !modal) {
                return;
            }

            // Gestion de l'activation/désactivation du bouton
            var requiredInputs = form.querySelectorAll('input[required]');

            function allRequiredFilled() {
                for (var i = 0; i < requiredInputs.length; i++) {
                    var input = requiredInputs[i];
                    if (!input.value || input.value.trim() === '') {
                        return false;
                    }
                    if (input.type === 'email') {
                        // Validation très simple de l'email côté front
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value.trim())) {
                            return false;
                        }
                    }
                }
                return true;
            }

            function updateButtonState() {
                if (allRequiredFilled()) {
                    confirmBtn.disabled = false;
                    confirmBtn.classList.remove('disabled');
                } else {
                    confirmBtn.disabled = true;
                    confirmBtn.classList.add('disabled');
                }
            }

            // Initialisation de l'état du bouton
            updateButtonState();

            requiredInputs.forEach(function (input) {
                input.addEventListener('input', updateButtonState);
                input.addEventListener('change', updateButtonState);
            });

            function openModal() {
                modal.style.display = 'block';
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            confirmBtn.addEventListener('click', function (e) {
                // Si, pour une raison quelconque, le bouton n'est pas désactivé mais que les champs ne sont pas valides, on bloque.
                if (!allRequiredFilled()) {
                    e.preventDefault();
                    return;
                }

                e.preventDefault();
                openModal();
            });

            if (btnPaiementLivraison) {
                btnPaiementLivraison.addEventListener('click', function () {
                    hiddenTypeCommande.value = 'livraison';
                    form.submit();
                });
            }

            if (btnPaiementDirect) {
                btnPaiementDirect.addEventListener('click', function () {
                    // Ne fait rien côté backend pour le moment, on ferme juste le modal
                    closeModal();
                });
            }

            // Fermer le modal si on clique sur le backdrop
            var backdrop = modal.querySelector('.payment-modal-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeModal);
            }
        });
    </script>

@endsection
