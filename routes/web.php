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
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SousCategoryController;
use App\Http\Controllers\TypeProduitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/* --------------------------------------------------------------------------
| Public / Front-office Routes
| -------------------------------------------------------------------------- */

// Search
Route::get('/search-produits', [ProduitController::class, 'search'])->name('produits.search');
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Home & Static pages
Route::get('/', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/notre-boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/boutique/{slug}', [HomeController::class, 'descriptionProduit'])->name('produit.description');
Route::get('/mescommandes', [HomeController::class, 'mescommandes'])->name('mescommandes');
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

// Services
Route::get('/fourniture-de-solution-informatique', [HomeController::class, 'solution'])->name('solution');
Route::get('/entretien-et-maintenance-de-materiels-informatiques', [HomeController::class, 'maintenance'])->name('maintenance');
Route::get('/travaux-de-cablages-reseaux-informatique-et-telephonique', [HomeController::class, 'cablage'])->name('cablage');

/* --------------------------------------------------------------------------
| Cart / Panier Routes
| -------------------------------------------------------------------------- */
Route::prefix('panier')->group(function () {
    Route::get('/', [PanierController::class, 'afficher'])->name('panier.afficher');
    Route::post('/ajouter', function (Request $request) {
        $id = $request->input('id');
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
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $panier[] = $produit;
        }
        session()->put('panier', $panier);
        return response()->json(['success' => true]);
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
    
    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/registerstore', [AdminController::class, 'register'])->name('adminstore.register');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/loginstore', [AdminController::class, 'loginstore'])->name('admin.loginstore');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');
});
/* --------------------------------------------------------------------------
| Dashboard Management Routes
| -------------------------------------------------------------------------- */
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/devis', [DashboardController::class, 'liste_devis'])->name('devis.index');
    Route::get('/devis/{devis}', [DashboardController::class, 'show_devis'])->name('devis.show');
    Route::resources([
    'typeproduits' => TypeProduitController::class,
    'actuconseils' => ActuConseilsController::class,
    'categories'   => CategoryController::class,
    'produits'     => ProduitController::class,
    'stocks'       => StockController::class,
]);
Route::resource('commandes', CommandeController::class)->except(['show']);
Route::get('/commandes/{commande}/valider', [CommandeController::class, 'valider'])->name('commandes.valider');
Route::get('/commandes/{commande}/annuler', [CommandeController::class, 'annuler'])->name('commandes.annuler');

});

/* --------------------------------------------------------------------------
| Resource Routes (Admin)
| -------------------------------------------------------------------------- */


// Brands
Route::post('brands', [BrandController::class, 'store'])->name('brands.store');


/* --------------------------------------------------------------------------
| Users & Roles & Permissions Management
| -------------------------------------------------------------------------- */
Route::prefix('admin')->group(function () {
    // Users
    Route::resource('users', UserController::class)->except(['show']);
    // Roles
    Route::resource('roles', RoleController::class)->except(['show']);
    // Permissions
    Route::resource('permissions', PermissionController::class)->except(['show']);
});

/* --------------------------------------------------------------------------
| Authenticated User Profile Routes
| -------------------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

/* --------------------------------------------------------------------------
| Auth routes (Laravel Breeze / Fortify / etc.)
| -------------------------------------------------------------------------- */
require __DIR__.'/auth.php';
