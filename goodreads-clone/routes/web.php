<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

// Comente ou remova esta linha (que exibe a welcome page padrão):
// Route::get('/', function () {
//     return view('welcome');
// });

// Redirecione a rota raiz ("/") para a listagem de livros:
Route::get('/', function() {
    return redirect()->route('books.index');
});

// Agora registre as rotas resource para Books e Authors:
Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
