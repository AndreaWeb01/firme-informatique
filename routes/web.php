<?php

use App\Http\Controllers\ActuConseilsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SousCategoryController;
use App\Http\Controllers\TypeProduitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/notre-boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/boutique/{slug}', [HomeController::class, 'descriptionProduit'])->name('produit.description');

Route::get('/conseils', [HomeController::class, 'conseils'])->name('conseils');
Route::get('/conseils/{slug}', [HomeController::class, 'conseilshow'])->name('conseils.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contactstore', [HomeController::class, 'contact_store'])->name('contact.store');

// Boutique 
Route::get('/fourniture-de-materiels-accessoires-informatique-et-consommables', [HomeController::class, 'accessoiresmaterielinfo'])->name('accessoiresmaterielinfo');
Route::get('/fourniture-de-materiels-informatique', [HomeController::class, 'materielinfo'])->name('materielinfo');
Route::get('/installation-de-camera-de-surveillance-et-systeme-de-securité', [HomeController::class, 'installationcamera'])->name('installationcamera');

// Services 
Route::get('/fourniture-de-solution-informatique', [HomeController::class, 'solution'])->name('solution');
Route::get('/entretien-et-maintenance-de-materiels-informatiques', [HomeController::class, 'maintenance'])->name('maintenance');
Route::get('/travaux-de-cablages-reseaux-informatique-et-telephonique', [HomeController::class, 'cablage'])->name('cablage');




//------------------- END VUE UTILISATEUR ------------------------------------//




Route::get('/detail-panier', [PanierController::class, 'afficher'])->name('panier.afficher');
Route::get('/confirmer-paiement', [PanierController::class, 'confirm_pay'])->name('confirm.payment');

// Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
// Route::get('/panier/contenu', [PanierController::class, 'contenu'])->name('panier.contenu');
// Route::post('/panier/majpanier', [PanierController::class, 'majPanier'])->name('panier.majpanier');



Route::post('/ajouter-au-panier', function (Request $request) {
   $id = $request->input('id');
    $produit = [
        'id' => $id,
        'name' => $request->input('name'),
        'prix' => $request->input('prix'),
        'image' => $request->input('image'),
        'quantity' => 1, // ✅ ajouter quantité par défaut
    ];

    $panier = session()->get('panier', []);
    
    // Vérifie si produit déjà dans le panier
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
   
   
   
    // $produit = $request->only(['id', 'name', 'prix', 'image']);

    // $panier = session()->get('panier', []);
    // $panier[] = $produit;
    // session()->put('panier', $panier);

    // return response()->json(['success' => true]);
})->name('panier.ajouter');


Route::get('/panier-produits', function () {
    $panier = session()->get('panier', []);
     return response()->json($panier);
    //  return response()->json(array_values($panier));
    // dd($panier);

})->name('panier.contenu');


Route::post('/maj-quantite-panier', [PanierController::class, 'mettreAJourQuantite'])->name('panier.majpanier');
Route::post('/panier/supprimer', [PanierController::class, 'supprimer'])->name('panier.supprimer');



// Route::post('/ajouter-au-panier', [PanierController::class, 'ajouter'])->name('panier.ajouter');
// Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');

// Route::get('/panier/lister', [PanierController::class, 'lister'])->name('panier.lister');
// Route::get('/panier/contenu', [PanierController::class, 'contenu'])->name('panier.contenu');

// Ajout au panier
// Route::post('/panier/ajouter', function (\Illuminate\Http\Request $request) {
//      $panier = session()->get('panier', []);

//     $produit_id = $request->produit_id;

//     if (isset($panier[$produit_id])) {
//         $panier[$produit_id]['quantite'] += 1;
//     } else {
//         $panier[$produit_id] = [
//             'nom_produit' => $request->nom_produit,
//             'prix' => $request->prix,
//             'quantite' => 1
//         ];
//     }

//     session()->put('panier', $panier);

//     return response()->json([
//         'panier' => array_values($panier)
//     ]);
// })->name('panier.contenu');









// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Route::middleware('guest')->prefix('admin')->group(function () {
//     // Page de connexion pour les administrateurs
//     Route::get('login', [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
//     Route::post('login', [AuthenticatedSessionController::class, 'storeAdmin']);
// });


Route::get('administration/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
Route::post('administration/registerstore', [AdminController::class, 'register'])->name('adminstore.register');

Route::get('administration/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


Route::get('administration/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('administration/loginstore', [AdminController::class, 'loginstore'])->name('admin.loginstore');



// ---------------- DASHBOARD --------------------------------- //

Route::get('liste-devis', [DashboardController::class, 'liste_devis'])->name('devis.index');
Route::get('voir-devis/{devis}', [DashboardController::class, 'show_devis'])->name('devis.show');


// ---------------- TypesProduits --------------------------------- //

Route::resource('typeproduits', TypeProduitController::class);





// ---------------- Conseils --------------------------------- //

Route::resource('actuconseils', ActuConseilsController::class);


// ---------------- CATEGORY --------------------------------- //

Route::resource('categories', CategoryController::class);


// ---------------- SOUS-CATEGORY --------------------------------- //

// Route::resource('subcategories', SousCategoryController::class);

// ---------------- BRANDS --------------------------------- //

Route::post('brands', [BrandController::class, 'store'])->name('brands.store');

// ---------------- PRODUITS --------------------------------- //

Route::resource('produits', ProduitController::class);


// ---------------- USERS --------------------------------- //

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('users/{userId}/delete', [UserController::class, 'destroy'])->name('users.destroy');


// ------------------ ROLES ------------------------------- //

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.addPermissionToRole');
Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.givePermissionToRole');


// ------------------ PERMISSIONS ------------------------------- //

Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy'])->name('permissions.destroy');


// --------------- NORMAL ------------------ //

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// --------------- FIN NORMAL ------------------ //