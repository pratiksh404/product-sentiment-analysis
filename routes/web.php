<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::admineticAuth();

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('product/{product:uuid}', [ProductController::class, 'show'])->name('product.show');

    Route::post('import-products', [ProductController::class, 'import'])->name('import-products');
});
