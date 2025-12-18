@extends("layouts.back.master")
@section('title', 'Dashboard')
@section('contenu')

    





<style>
    /* ----------- GLOBAL ----------- */
    body { background: #f0f2f5; }

    .container-dashboard {
        padding: 25px;
    }

    h1 {
        margin-bottom: 25px;
        font-weight: 700;
        font-size: 28px;
    }

    /* ----------- CARDS ----------- */
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 25px;
    }

    .cardx {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.07);
        transition: 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .cardx:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .card-icon {
        font-size: 50px;
        position: absolute;
        top: -12px;
        right: -12px;
        opacity: 0.17;
    }

    .card-title {
        font-size: 15px;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 10px;
    }

    .card-value {
        font-size: 32px;
        font-weight: bold;
    }

    /* ----------- ROW / BOX ----------- */
    .rowx {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 35px;
    }

    .chart-box, .table-box, .products-box {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.06);
        flex: 1;
        min-width: 350px;
    }

    .chart-placeholder {
        height: 280px;
        border-radius: 14px;
        background: linear-gradient(135deg, #e7ebff, #f4f6ff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #777;
        margin-top: 20px;
    }

    /* ----------- TABLE ----------- */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th {
        text-align: left;
        padding: 12px;
        background: #f9f9f9;
        font-size: 14px;
        text-transform: uppercase;
        color: #666;
    }

    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .badge {
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .success { background: #28c76f; }
    .warning { background: #ff9f43; }
    .danger  { background: #ea5455; }

    /* ----------- PRODUITS ----------- */
    .product-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin-top: 15px;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-item img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 10px;
    }

    .product-info h4 {
        margin-bottom: 2px;
        font-size: 16px;
    }

    .product-info p {
        font-size: 13px;
        color: #777;
    }

</style>


<div class="container-dashboard">

   


    <h1>Dashboard E-commerce Premium</h1>

   <div class="stats">

        <div class="cardx">
            <i class='bx bx-package card-icon'></i>
            <p class="card-title">Produits</p>
            <h2 class="card-value">{{ $produits ?? 248 }}</h2>
        </div>

        <div class="cardx">
            <i class='bx bx-cart-alt card-icon'></i>
            <p class="card-title">Commandes</p>
            <h2 class="card-value">{{ $commandes ?? 1452 }}</h2>
        </div>

        <div class="cardx">
            <i class='bx bx-dollar-circle card-icon'></i>
            <p class="card-title">Chiffre d’affaires</p>
            <h2 class="card-value">{{ $ca ?? "3.5M FCFA" }}</h2>
        </div>

        <div class="cardx">
            <i class='bx bx-user card-icon'></i>
            <p class="card-title">Clients</p>
            <h2 class="card-value">{{ $clients ?? 786 }}</h2>
        </div>

    </div>

  <!-- Graph + Table + Products -->
    <div class="rowx">

      
        <div class="chart-box">
            <h2>Ventes Mensuelles</h2>
            <div class="chart-placeholder">
                Graphique ici (ApexCharts possible)
            </div>
        </div>

        <div class="table-box">
            <h2>Dernières Commandes</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Status</th>
                </tr>
            @foreach($commandesrecent as $commander)
                <tr>
                    <td>{{ $commander->numero_commande }}</td>
                    <td>{{ $commander->user->name ?? $commander->nom }}</td>    
                    <td>{{ $commander->montant_total }}</td>
                    <td><span class="badge {{ $commander->statut == 'payée' ? 'success' : ($commander->statut == 'en_attente' ? 'warning' : 'danger') }}">{{ $commander->statut }}</span></td>  
                </tr>
            @endforeach 
            </table>
        </div>


    </div>

 </div>




        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Deconnexion</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

@endsection