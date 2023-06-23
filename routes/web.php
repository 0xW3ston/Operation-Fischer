<?php

// [ Laravel Essentials ]:
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// [ Admin Controllers ]:
use App\Http\Controllers\admin_authController;
use App\Http\Controllers\admin_categorieController;
use App\Http\Controllers\admin_commandeController;
use App\Http\Controllers\admin_productController;

// [ Client Controllers ]:
use App\Http\Controllers\client_authController;
use App\Http\Controllers\client_categorieController;
use App\Http\Controllers\client_cartController;
use App\Http\Controllers\client_commandeController;
use App\Http\Controllers\client_productController;
use App\Http\Controllers\client_profileController;

use App\Models\Categorie;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/','welcome');
Route::redirect('/','/products');

// Route::post('/',function (Request $request){
//     // $request->hasFile('img');
//         $response = $request->file("img")->store('goodImage');
//         return dd($response);
// });

Route::get('/products', function () {
    $paginate_data = Categorie::find(24)->articles()->paginate(1);
    return view('pages.client.products',['paginator' => $paginate_data]);
});

// ->middleware([])

// Route::get('/new',[admin_commandeController::class,'store']);

// Route::view('/test','pages.components.test');

Route::prefix('admin')->middleware('isAuthed:admin')->name('admin.')->group(function () {

    Route::view('dashboard','pages.admin.dashboard',['notifications' => Notification::where('role','admin')->latest()->limit(10)->get()])->name('dashboard');

    Route::get('login', [admin_authController::class,'index'])->name('login.form')->withoutMiddleware('isAuthed:admin');
    Route::post('login',  [admin_authController::class,'login'])->name('login')->withoutMiddleware('isAuthed:admin');

    Route::get('logout', [admin_authController::class,'logout'])->name('logout');

    // [Categories]:
    Route::get('/categories', [admin_categorieController::class,'index'])->name('categorie.all');
    Route::get('/categorie/add', [admin_categorieController::class, 'create'])->name('categorie.add');
    Route::get('/categorie/update/{id}', [admin_categorieController::class, 'edit'])->name('categorie.edit');

    Route::post('/categorie/add', [admin_categorieController::class, 'store'])->name('categorie.ajouter');
    Route::get('/categorie/delete/{id}', [admin_productController::class,'destroy'])->name('categorie.delete');
    Route::post('/categorie/update/{id}', [admin_categorieController::class, 'update'])->name('categorie.update');

    // [Products]:
    Route::get('/products', [admin_productController::class,'index'])->name('product.all');
    Route::get('/product/add', [admin_productController::class,'create'])->name('product.add');
    Route::get('/product/update/{id}', [admin_productController::class,'edit'])->name('product.edit');

    Route::post('/product/add', [admin_productController::class,'store'])->name('product.ajouter');
    Route::get('/product/delete/{id}', [admin_productController::class,'destroy'])->name('product.delete');
    Route::post('/product/update/{id}', [admin_productController::class,'update'])->name('product.update');

    // [Commandes: Admin]:
    Route::get('/commandes', [admin_commandeController::class, 'index'])->name('commande.all');
    Route::get('/commande/validate/{id}', [admin_commandeController::class, 'update'])->name('commande.update');
    Route::get('/commande/delete/{id}', [admin_commandeController::class, 'destroy'])->name('commande.delete');


});


// // [Categories & Products]
Route::get('/categories', [client_categorieController::class, 'index'])->name('client.categories');
Route::get('/products', [client_productController::class, 'index'])->name('client.products');
Route::get('/product/{id}',[client_productController::class,'show'])->name('client.product');

// [Dashboard : Client]
Route::view('/dashboard', 'pages.client.dashboard')->name('client.dashboard');

// ->middleware('isAuthed:client'):
Route::name('client.')->middleware('isAuthed:client')->group(function () {
    
    // [Commandes: client]
    // Route::get('/commandes', [client_commandeController::class, 'index'])->name('orders');
    // Route::get('/commande/{id}', [client_commandeController::class, 'show'])->name('order.show');
    // Route::post('/commandes', [client_commandeController::class, 'store'])->name('order.store');
    Route::get('/commande/ajouter',[client_commandeController::class,'store'])->name('commande.ajouter');

    // [Cart]
    Route::get('/cart', [client_cartController::class, 'index'])->name('cart');
    Route::get('/cart/show', [client_cartController::class, 'show'])->name('cart.show');
    Route::get('/cart/add/{id}', [client_cartController::class, 'create'])->name('cart.add');
    Route::get('/cart/remove/{id}', [client_cartController::class, 'destroy'])->name('cart.remove');
    Route::get('/cart/clear', [client_cartController::class, 'clear'])->name('cart.clear');

    // Profile routes
    Route::get('/profile', [client_productController::class, 'index'])->name('profile');
    Route::post('/profile/update', [client_productController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [client_productController::class, 'updatePassword'])->name('profile.password');
});

// Authentication routes
Route::get('/login', [client_authController::class, 'index'])->name('client.login.form');
Route::post('/login', [client_authController::class, 'login'])->name('client.login');

Route::get('/logout', [client_authController::class, 'logout'])->name('client.logout');
Route::get('/register', [client_authController::class, 'create'])->name('client.register.form');
Route::post('/register', [client_authController::class, 'store'])->name('client.register'); 