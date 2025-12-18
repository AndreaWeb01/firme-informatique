@extends("layouts.front.app")

@section('title', 'Accueil')

@section('banner')
<div class="about-contents">
    <h1 style="text-align:center; font-weight:bold; line-height:1.4;">Mon tableau de bord</h1>
    <p style="text-align:center; color:#666;">Bienvenue, {{ auth()->user()->name ?? 'Client' }}</p>
</div>
@endsection

@section('content')
<main>
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Tableau de bord</p>
        </div>
    </section>

         <section class="py-3">
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
                    <li><a href="dashboard-adress.html">Mes adresses</a></li>
                    <li><a href="#">Devis</a></li>
                    <li><a href="#">Déconnexion</a></li>
                </ul>
                </div>

                <div class="dash-link">
                    <div class="command">
                        <a href="#" class="activate">Ma commande</a>
                    </div>
                    <div class="command">
                        <a href="dashboard-adress.html">Mon adresse</a>
                    </div>
                    <div class="command">
                        <a href="#">Devis</a>
                    </div>
                    <div class="command">
                        <a href="#">Deconnexion</a>
                    </div>
                </div>

                <div class="tableau-dash">
                    <table class="table-dash  text-center">
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
                        <tbody>
                             @foreach($commandes as $cmd)
                                @php
                                    $badge = $cmd->statut === 'payée' ? 'success' : ($cmd->statut === 'en_attente' ? 'warning' : 'danger');
                                @endphp
                                <tr>
                                    <td>{{ $cmd->numero_commande }}</td>
                                    <td>{{ $cmd->created_at?->format('d/m/Y H:i') }}</td>
                                    <td>{{ number_format($cmd->montant_total ?? 0, 0, ',', ' ') }} FCFA</td>
                                    <td><span class="badge {{ $badge }}">{{ $cmd->statut }}</span></td>
                                </tr>
                            @endforeach
                              
                        
                        </tbody>
                
                    </table>
    

                </div>
                
            </div>
           </div>
        </section>

        
        <section class="mb-4 mt-5">
            <div class="wrap">
                <div class="title">
                    <h1>vue récemment</h1>
                </div>
            </div>
        </section>
        @if($products->count() > 0)
    <h3>Produits récemment vus</h3>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('product.show', $product->id) }}">
                    {{ $product->name }}
                </a>
                <!-- Ajouter ici d'autres détails du produit si nécessaire -->
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun produit récemment vu.</p>
@endif



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
@endsection
