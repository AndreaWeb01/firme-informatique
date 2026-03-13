@extends("layouts.front.app")

@section('title', 'Accueil')

@section('banner')
<div class="about-contents">
    <h1 style="text-align:center; font-weight:bold; line-height:1.4;">Mon tableau de bord</h1>
    <p style="text-align:center; color:#666;">Bienvenue, {{ auth()->user()->name ?? 'Client' }}</p>
</div>
@endsection

@section('content')


<main class="container">
    <section class="dashboard-section1">
        <div class="wrap">
            <p class=""><a href="{{ route('accueil') }}">Accueil</a> / Tableau de bord</p>
        </div>
    </section>

         <div class="dashboard-section">
           <div class="wrap">
            <!-- <p style="margin-bottom: 60px; padding: 0 80px;"> Dashboard</p> -->
            <div class="dash-board">

                                <!-- MENU TOGGLE (icône burger) -->
                <div class="menu-toggle">

                    <span style="font-size: 16px; font-weight: bold;">Mes commandes</span>
                    <i class="fas fa-chevron-right chevron"></i>


                </div>

                <!-- MENU MOBILE -->
                <div class="menu-mobile">
                <div class="menu-header">
                    <span>Mon compte</span>
                    <span class="close-btn">&times;</span>
                </div>
                <ul>
                    <li class="active"><a href="#">Mes commandes</a></li>
                    <li><a href="#">Mes adresses</a></li>
                    <li><a href="{{ route('mesdevis') }}">Devis</a></li>
                    <li><a href="#">Déconnexion</a></li>
                </ul>
                </div>

                <div class="dash-link">
                    <div class="command">
                        <a href="#" class="activate">Ma commande</a>
                    </div>
                    <div class="command">
                        <a href="#" id="open-address-modal">Mon adresse</a>
                    </div>
                    <div class="command">
                        <a href="{{ route('mesdevis') }}">Devis</a>
                    </div>
                    <div class="command">
                        <a href="#">Deconnexion</a>
                    </div>
                </div>

                <div class="tableau-dash">
                    <table class="table-dash  text-center" >
                        <thead>
                            <tr>
                                <th>Commande</th>
                                <th>Date</th>
                                <th>Etat de paiement</th>
                                <th>Etat de livraison</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                             @foreach($commandes as $cmd)
                                @php
                                    $badge = $cmd->statut === 'payée' ? 'success' : ($cmd->statut === 'en_attente' ? 'warning' : 'danger');
                                @endphp
                                <tr class="mt-2">
                                    <td class="text">{{ $cmd->numero_commande }}</td>
                                    <td>{{ $cmd->created_at?->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge {{ $badge }}">{{ $cmd->statut }}</span></td>
                                    <td>En cours</td>
                                    <td>{{ number_format($cmd->montant_total ?? 0, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <a href="{{ route('detailcommande', $cmd->numero_commande) }}" class="btn-yellow" style="padding:2px 8px;font-size:14px;">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>


                </div>

            </div>
           </div>
        </div>


        <section class="mb-4 mt-5">
            <div class="wrap">
                <div class="title">
                    <h1>vue récemment</h1>
                </div>
            </div>
        </section>
        @if($products->count() > 0)
    <ul>
        @foreach($products as $product)
            <div>
                <a href="{{ route('produit.description', ['slug' => $product->slug, 'id' => $product->id]) }}">
                    {{ $product->name }}
                </a>
                <img src="{{ $product->image_principale }}" alt="">
                <!-- Ajouter ici d'autres détails du produit si nécessaire -->
                <p>{{ $product->description }}</p>
            </div>

        @endforeach
    </ul>
@else
    <p>Aucun produit récemment vu.</p>
@endif

    {{-- Modal adresse --}}
    <div id="address-modal" class="address-modal" style="display:none; position:fixed; inset:0; z-index:9999;">
        <div class="address-modal-backdrop" style="position:absolute; inset:0; background:rgba(15,23,42,0.6);"></div>
        <div class="address-modal-content"
             style="
                position:relative;
                max-width:520px;
                margin:80px auto;
                background:#ffffff;
                border-radius:16px;
                padding:24px 24px 20px;
                box-shadow:0 20px 40px rgba(15,23,42,0.35);
                display:flex;
                flex-direction:column;
                gap:14px;
             ">
            <div style="display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <h5 style="margin:0 0 4px; font-size:18px; font-weight:600; color:#0f172a;">
                        Mon adresse
                    </h5>
                    <p style="margin:0; font-size:13px; color:#6b7280;">
                        Consultez ou mettez à jour vos informations d’adresse.
                    </p>
                </div>
                <button type="button"
                        id="close-address-modal"
                        aria-label="Fermer"
                        style="
                            border:none;
                            background:transparent;
                            font-size:20px;
                            line-height:1;
                            cursor:pointer;
                            color:#9ca3af;
                        ">
                    ×
                </button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label style="display:block; font-size:13px; margin-bottom:4px;">Nom</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name ?? '') }}"
                               required
                               class="box"
                               style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #e5e7eb;">
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; margin-bottom:4px;">Prénom</label>
                        <input type="text"
                               name="prenom"
                               value="{{ old('prenom', auth()->user()->prenom ?? '') }}"
                               class="box"
                               style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #e5e7eb;">
                    </div>
                </div>

                <div style="margin-top:10px; display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label style="display:block; font-size:13px; margin-bottom:4px;">Téléphone</label>
                        <input type="tel"
                               name="telephone"
                               value="{{ old('telephone', auth()->user()->telephone ?? '') }}"
                               pattern="[0-9]*"
                               inputmode="numeric"
                               class="box"
                               style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #e5e7eb;">
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; margin-bottom:4px;">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               required
                               class="box"
                               style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid #e5e7eb;">
                    </div>
                </div>

                <div style="margin-top:14px; display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button"
                            id="cancel-address-modal"
                            style="
                                padding:8px 14px;
                                border-radius:999px;
                                border:1px solid #e5e7eb;
                                background:#ffffff;
                                font-size:13px;
                                cursor:pointer;
                            ">
                        Fermer
                    </button>
                    <button type="submit"
                            style="
                                padding:8px 16px;
                                border-radius:999px;
                                border:none;
                                background:#facc15;
                                color:#111827;
                                font-size:13px;
                                font-weight:600;
                                cursor:pointer;
                            ">
                        Enregistrer mon adresse
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>


<style>
/* Mise en page simple du dashboard */
.dashboard-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px}
.card{background:#fff;border-radius:10px;box-shadow:0 4px 14px rgba(0,0,0,0.08)}
.card h3{padding:16px 20px;margin:0;border-bottom:1px solid #f0f0f0}
.card.info .info-list{list-style:none;margin:0;padding:16px 20px}
.card.info .info-list li{margin-bottom:8px;color:#333}
.card.info .btn-yellow{margin:0 20px 16px;display:inline-block}
.card.actions .actions-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;padding:16px 20px}
.card.actions .action{display:flex;flex-direction:column;align-items:center;gap:8px;padding:14px;border:1px solid #eee;border-radius:8px;color:#0261CD;text-decoration:none}
.card.actions .action i{font-size:20px}
.card.table{padding-bottom:8px}
.table-header{display:flex;align-items:center;justify-content:space-between;padding:12px 20px}
.table-header .link{color:#0261CD;text-decoration:none}
.table-responsive{padding:0 20px 16px}
table.tablex{width:100%;border-collapse:collapse}
table.tablex th, table.tablex td{padding:12px;border-bottom:1px solid #f0f0f0;text-align:left}
.badge{display:inline-block;padding:4px 10px;border-radius:20px;font-size:12px}
.badge.success{background:#e6f6e9;color:#1b7f3a}
.badge.warning{background:#fff4e5;color:#b06a00}
.badge.danger{background:#fdecea;color:#b00020}
@media (max-width:900px){.dashboard-grid{grid-template-columns:1fr}.card.actions .actions-grid{grid-template-columns:repeat(2,1fr)}}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var openBtn = document.getElementById('open-address-modal');
        var modal = document.getElementById('address-modal');
        if (!openBtn || !modal) {
            return;
        }

        var closeBtn = document.getElementById('close-address-modal');
        var cancelBtn = document.getElementById('cancel-address-modal');
        var backdrop = modal.querySelector('.address-modal-backdrop');

        function openModal() {
            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeModal);
        }
        if (backdrop) {
            backdrop.addEventListener('click', closeModal);
        }
    });
</script>
@endsection