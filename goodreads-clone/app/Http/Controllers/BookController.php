<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Exibe a lista de livros, com filtro de busca (search).
     */
    public function index(Request $request)
    {
        // Busca por título ou pelo nome do autor
        $query = Book::with('author');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'ILIKE', "%{$search}%")
                  ->orWhereHas('author', function($q) use ($search) {
                      $q->where('name', 'ILIKE', "%{$search}%");
                  });
        }

        $books = $query->orderBy('title')->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Exibe o formulário para criar um novo livro.
     */
    public function create()
    {
        // Precisamos da lista de autores para o select
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    /**
     * Armazena um novo livro no banco, incluindo upload de imagem opcional.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author_id'   => 'required|exists:authors,id',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048' // até 2MB
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create([
            'title'       => $request->title,
            'author_id'   => $request->author_id,
            'description' => $request->description,
            'cover_image' => $coverPath
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um livro específico (opcional).
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Exibe o formulário de edição de um livro.
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Atualiza o livro no banco, incluindo possível troca de imagem.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author_id'   => 'required|exists:authors,id',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        // Se houver nova imagem, apagamos a antiga e salvamos a nova
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        } else {
            $coverPath = $book->cover_image; // mantém a antiga
        }

        $book->update([
            'title'       => $request->title,
            'author_id'   => $request->author_id,
            'description' => $request->description,
            'cover_image' => $coverPath
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove um livro e sua capa do storage, se existir.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('books.index')
                         ->with('success', 'Livro excluído com sucesso!');
    }
}
