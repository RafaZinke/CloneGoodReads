<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', function (Request $request) {
    
    $query = Book::with('author');


    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('title', 'ILIKE', "%{$search}%")
              ->orWhereHas('author', function ($q) use ($search) {
                  $q->where('name', 'ILIKE', "%{$search}%");
              });
    }
    $books = $query->get();

    return $books->map(function ($book) {
        return [
            'id'          => $book->id,
            'title'       => $book->title,
            'author_name' => $book->author->name,
            'description' => $book->description,
            'cover_url'   => $book->cover_image
                                ? asset('storage/' . $book->cover_image)
                                : null,
            'created_at'  => $book->created_at->toDateTimeString(),
        ];
    });
});
