<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'index'])->name('startLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login/recognize', [AuthController::class, 'login'])->name('login');
Route::post('/login/createAccount', [ProfileController::class, 'createAccount'])->name('createAccount');
Route::middleware(['admin'])->group(function () {
    //Users
    Route::get('/users', [UserController::class, 'index'])->name('indexUsers');
    Route::get('/users/create', [UserController::class, 'create'])->name('createUsers');
    Route::post('/create/store', [UserController::class, 'store'])->name('storeUsers');
    Route::post('/users/destroy/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/datatable/getUsers', [DatatableController::class, 'getUsers'])->name('getUsers');
    //Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('indexCategories');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('createCategories');
    Route::post('/category/create/store', [CategoryController::class, 'store'])->name('storeCategories');
    Route::post('/category/destroy/{id}/{action}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::get('/datatable/getCategories', [DatatableController::class, 'getCategories'])->name('getCategories');
    Route::post('/category/dataSubcategory', [CategoryController::class, 'dataSubcategory'])->name('dataSubcategory');
    //Products
    Route::get('/products', [ProductController::class, 'index'])->name('indexProducts');
    Route::get('/products/create', [ProductController::class, 'create'])->name('createProducts');
    Route::post('/create/store', [ProductController::class, 'store'])->name('storeProducts');
    Route::post('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('deleteProducts');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('updateProducts');
    Route::get('/datatable/getProducts', [DatatableController::class, 'getProducts'])->name('getProducts');
    Route::post('/products/subcategorySelector', [CategoryController::class, 'dataSubcategory'])->name('subcategorySelector');
    Route::post('/subcategorySelector', [CategoryController::class, 'dataSubcategory'])->name('subcategorySelector');
    Route::post('/searchCategory', [CategoryController::class, 'dataCategory'])->name('searchCategory');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('updatedataUser');
    Route::get('/address', [AddressController::class, 'index'])->name('address');
    Route::post('/address/store', [AddressController::class, 'store'])->name('storeAddress');
    Route::post('/address/update/{id}', [AddressController::class, 'update'])->name('updateAddress');
    Route::post('/dataAddress', [AddressController::class, 'dataAddress'])->name('dataAddress');
    Route::post('/address/destroy/{id}', [AddressController::class, 'destroy'])->name('deleteAddress');
});
