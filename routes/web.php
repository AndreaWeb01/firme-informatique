<?php

use App\Http\Controllers\ActuConseilsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SousCategoryController;
use App\Http\Controllers\TypeProduitController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use App\Models\Stock;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/* --------------------------------------------------------------------------
| Public / Front-office Routes
| -------------------------------------------------------------------------- */

// Search
Route::get('/search-produits', [ProduitController::class, 'search'])->name('produits.search');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// Home & Static pages
Route::get('/', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/notre-boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/mescommandes', [HomeController::class, 'dashboard'])->name('mescommandes');
Route::get('/detailcommande/{numero_commande}', [HomeController::class, 'detailcommande'])->name('detailcommande');



Route::get('/conseils', [HomeController::class, 'conseils'])->name('conseils');
Route::get('/conseils/{slug}', [HomeController::class, 'conseilshow'])->name('conseils.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contactstore', [HomeController::class, 'contact_store'])->name('contact.store');

// Boutique categories
Route::get('/fourniture-de-materiels-accessoires-informatique-et-consommables', [HomeController::class, 'accessoiresmaterielinfo'])->name('accessoiresmaterielinfo');
Route::get('/fourniture-de-materiels-informatique', [HomeController::class, 'materielinfo'])->name('materielinfo');
Route::get('/installation-de-camera-de-surveillance-et-systeme-de-securité', [HomeController::class, 'installationcamera'])->name('installationcamera');
Route::get('/boutique/filter/{id}', [HomeController::class, 'filterAjax'])->name('boutique.filterAjax');
Route::get('/boutique/filter-category/{id}', [HomeController::class, 'filterByCategory'])->name('boutique.filterByCategory');
Route::get('/boutique/filter-combined', [HomeController::class, 'filterCombined'])->name('boutique.filterCombined');
Route::get('/boutique/{slug}/{id}', [HomeController::class, 'descriptionProduit'])->name('produit.description');

// Services
Route::get('/fourniture-de-solution-informatique/{Id}', [HomeController::class, 'solution'])->name('solution');
Route::get('/entretien-et-maintenance-de-materiels-informatiques', [HomeController::class, 'maintenance'])->name('maintenance');
Route::get('/travaux-de-cablages-reseaux-informatique-et-telephonique', [HomeController::class, 'cablage'])->name('cablage');

/* --------------------------------------------------------------------------
| Cart / Panier Routes
| -------------------------------------------------------------------------- */
Route::prefix('panier')->group(function () {
    Route::get('/', [PanierController::class, 'afficher'])->name('panier.afficher');
    Route::post('/ajouter', function (Request $request) {
        $id = $request->input('id');

        $stockActuel = (int) Stock::where('produit_id', $id)->sum('quantité');
        if ($stockActuel <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Stock indisponible pour ce produit.',
                'stock' => $stockActuel,
            ], 409);
        }

        $produit = [
            'id' => $id,
            'name' => $request->input('name'),
            'prix' => $request->input('prix'),
            'image' => $request->input('image'),
            'quantity' => 1,
        ];

        $panier = session()->get('panier', []);
        $found = false;
        foreach ($panier as &$item) {
            if ($item['id'] == $id) {
                $newQty = ((int) ($item['quantity'] ?? 1)) + 1;
                if ($newQty > $stockActuel) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stock insuffisant. Stock disponible: {$stockActuel}.",
                        'stock' => $stockActuel,
                        'quantity' => $item['quantity'] ?? 1,
                    ], 409);
                }
                $item['quantity'] = $newQty;
                $found = true;
                break;
            }
        }
        if (!$found) {
            if (1 > $stockActuel) {
                return response()->json([
                    'success' => false,
                    'message' => "Stock insuffisant. Stock disponible: {$stockActuel}.",
                    'stock' => $stockActuel,
                    'quantity' => 0,
                ], 409);
            }
            $panier[] = $produit;
        }
        session()->put('panier', $panier);
        return response()->json(['success' => true, 'stock' => $stockActuel]);
    })->name('panier.ajouter');
    Route::get('/produits', function () {
        return response()->json(session()->get('panier', []));
    })->name('panier.contenu');
    Route::post('/maj-quantite', [PanierController::class, 'mettreAJourQuantite'])->name('panier.majpanier');
    Route::post('/supprimer', [PanierController::class, 'supprimer'])->name('panier.supprimer');
});
// Order validation
Route::post('/valider-commande', [CommandeController::class, 'validerPanier'])->name('commande.valider');
Route::get('/confirmer-paiement', [PanierController::class, 'confirm_pay'])->name('confirm.payment');
Route::post('/commandes/{commande}/changer-statut', [CommandeController::class, 'changerStatut'])
    ->name('commandes.changerStatut');

/* --------------------------------------------------------------------------
| Administration / Back-office Routes
| -------------------------------------------------------------------------- */
Route::prefix('administration')->group(function () {
    // Inscription admin accessible (création de compte)
    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/registerstore', [AdminController::class, 'register'])->name('adminstore.register');

    // Dashboard réservé aux administrateurs authentifiés
    Route::middleware(['auth', 'role:administrateur'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/loginstore', [AdminController::class, 'loginstore'])->name('admin.loginstore');
});
/* --------------------------------------------------------------------------
| Dashboard Management Routes
| -------------------------------------------------------------------------- */
Route::prefix('dashboard')->group(function () {
    Route::get('/devis', [DashboardController::class, 'liste_devis'])->name('devis.index');
    Route::get('/devis/{devis}', [DashboardController::class, 'show_devis'])->name('devis.show');
    Route::delete('/devis/{devis}', [DashboardController::class, 'destroy_devis'])->name('devis.destroy');
    Route::resource('commandes', CommandeController::class)->except(['show']);
    Route::resources([
        'typeproduits' => TypeProduitController::class,
        'actuconseils' => ActuConseilsController::class,
        'categories' => CategoryController::class,
        'produits' => ProduitController::class,
        'stocks' => StockController::class,

    ]);
    Route::get('/commandes/{commande}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
    Route::get('/commandes/{commande}/annuler', [CommandeController::class, 'annuler'])->name('commandes.annuler');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
});

/* --------------------------------------------------------------------------
| Resource Routes (Admin)
| -------------------------------------------------------------------------- */


// Brands
Route::post('brands', [BrandController::class, 'store'])->name('brands.store');


/* --------------------------------------------------------------------------
| Users & Roles & Permissions Management
| -------------------------------------------------------------------------- */
Route::prefix('admin')->middleware('auth')->group(function () {
    // Users
    Route::resource('users', UserController::class)->except(['show']);
    // Roles
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.addPermissionToRole');
    Route::put('roles/{role}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.givePermissionToRole');
    // Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);
});

/* --------------------------------------------------------------------------
| Authenticated User Profile Routes
| -------------------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/mescommandes', [HomeController::class, 'dashboard'])->name('mescommandes');
    Route::get('/mes-devis', [HomeController::class, 'mesDevis'])->name('mesdevis');
    Route::get('/detailcommande/{numero_commande}', [HomeController::class, 'detailcommande'])->name('detailcommande');
});


Route::get('/payer/{commande}', [PaymentController::class, 'payer'])->name('paiement.payer');

Route::post('/payment/create', [PaymentController::class, 'create'])
    ->name('payment.create');

Route::get('/payment/callback', [PaymentController::class, 'callback'])
    ->name('payment.callback');

Route::post('/payment/webhook', [PaymentController::class, 'webhook'])
    ->name('payment.webhook');

Route::get('/payment', function () {
    return view('payment.form');
});
/* --------------------------------------------------------------------------
| Auth routes (Laravel Breeze / Fortify / etc.)
| -------------------------------------------------------------------------- */
require __DIR__ . '/auth.php';
