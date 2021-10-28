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

Route::resource('clientes', 'ClienteController');
Route::resource('categorias', 'CategoriaController');
Route::resource('produtos', 'ProdutoController');
Route::resource('fornecedores', 'FornecedorController')->parameters(['fornecedores' => 'fornecedor']);
Route::resource('funcionarios', 'FuncionarioController');
Route::resource('empresas', 'EmpresaController');
Route::resource('vendas', 'VendaController');
