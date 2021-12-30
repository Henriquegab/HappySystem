<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;

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



Auth::routes();

Route::middleware('auth')->group(
    function(){


        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('clientes', ClienteController::class);
        Route::resource('produtos', ProdutoController::class);
        Route::resource('pedidos', PedidoController::class);
        Route::post('pedidos/store/{primeiro}', [PedidoController::class, 'store'])->name('pedido.store');
        Route::resource('pedidosProdutos', PedidoProdutoController::class);
        Route::get('pedido-produto/create/{id?}/{primeiro}/{pedido?}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
        Route::post('pedido-produto/store/{id?}/{primeiro}/{pedido?}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
        Route::get('pedido-produto/show/{pedidoProduto}/{primeiro}/{pedido}/{id?}', [PedidoProdutoController::class, 'show'])->name('pedido-produto.show');
        Route::delete('pedido-produto/destroy/{pedidoProduto}/{primeiro}/{pedido}/{produto}/{id?}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
        Route::get('pedido-produto/edit/{id?}/{primeiro}/{pedido?}/{quantidade?}', [PedidoProdutoController::class, 'edit'])->name('pedido-produto.edit');
        Route::put('pedido-produto/update/{id?}/{primeiro}/{pedido?}/{quantidade}', [PedidoProdutoController::class, 'update'])->name('pedido-produto.update');
    }

);