<?php

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


Route::get('/',App\Http\Livewire\LoginPageLivewire::class)->name('login');

Route::middleware('auth')->group(function(){
    Route::get('/home',App\Http\Livewire\HomePageLivewire::class)->name('home');
    Route::get('/produtos', App\Http\Livewire\ProdutosPageLivewire::class)->name('produtos');
    Route::get('/products', App\Http\Livewire\ProdutosCadastroLivewire::class)->name('produto-cadastro');
    Route::get('/produtos-editar/{id}', App\Http\Livewire\ProdutosEdicaoLivewire::class);
    Route::get('/produtos-delete/{id}', App\Action\DeletarProdutoAction::class);
});
