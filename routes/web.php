<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Psr7\Request;
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

// Route::get('/', function () {

//     // Teste de envio de informações para a view
//     // $nome = "Otávio";
//     // $idade = 21;
//     // return view('welcome', ['nome'=>$nome, 'idade'=>$idade, 'profissao'=>"Programador"]);
//     // Coloque esse trecho de código na view
//     // <p>{{ $nome }} - {{ $idade }} anos, trabalha como {{ $profissao }}</p>

//     return view('welcome');
// });

// Route::get('/products', [ProductController::class, 'search']);
// Route::get('/product/{id?}', [ProductController::class, 'view']);

Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/list', [EventController::class, 'list']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');