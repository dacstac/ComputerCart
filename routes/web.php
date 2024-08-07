<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::get('/create-users', [UserController::class, 'create'])->name('createUsers');
    Route::get('/show-users', [UserController::class, 'show'])->name('showUsers');
    Route::post('/create-users/store', [UserController::class, 'store'])->name('storeUsers');
    Route::post('/show-users/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/datatable/getUsers', [DatatableController::class, 'getUsers'])->name('getUsers');
    //Categories
    Route::get('/show-categories', [CategoryController::class, 'index'])->name('showCategories');
    Route::get('/create-categories', [CategoryController::class, 'create'])->name('createCategories');
    Route::post('/create-categories/store', [CategoryController::class, 'store'])->name('storeCategories');
    Route::get('/datatable/getCategories', [DatatableController::class, 'getCategories'])->name('getCategories');
    Route::post('/show-categories/delete/{id}/{action}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    Route::post('/show-categories/update/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::post('/dataSubcategory', [CategoryController::class, 'dataSubcategory'])->name('dataSubcategory');
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
