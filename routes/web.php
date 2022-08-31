<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\CoinsController;
use App\Http\Controllers\perfilcontroller;
use App\Http\Controllers\PruebaController;
use App\Http\Livewire\Permisoscontroller;
use App\Http\Livewire\Asignarcontroller;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\CompanyController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Exporter;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Test visuales
Route::get('ejemplo', [PruebaController::class, 'ejemplo']);