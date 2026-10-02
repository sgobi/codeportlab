<?php

use App\Http\Controllers\PortfolioController;
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

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::post('/', [PortfolioController::class, 'submitAudit'])->name('audit.submit');
Route::post('/contact', [PortfolioController::class, 'submitAudit']);

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');
