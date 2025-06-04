<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Exibe a lista de autores (index).
     */
    public function index()
    {
        $authors = Author::orderBy('name')->paginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Exibe o formulário para criar novo autor.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Armazena um novo autor no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name|max:255',
            'bio'  => 'nullable|string'
        ]);

        Author::create([
            'name' => $request->name,
            'bio'  => $request->bio
        ]);

        return redirect()->route('authors.index')
                         ->with('success', 'Autor criado com sucesso!');
    }

    /**
     * Exibe detalhes de um autor específico (opcional).
     */
    public function show(Author $author)
    {
        // Poderíamos listar aqui os livros deste autor, por exemplo
        $books = $author->books()->paginate(5);
        return view('authors.show', compact('author', 'books'));
    }

    /**
     * Exibe o formulário de edição de um autor.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Atualiza o autor no banco.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name,' . $author->id . '|max:255',
            'bio'  => 'nullable|string'
        ]);

        $author->update([
            'name' => $request->name,
            'bio'  => $request->bio
        ]);

        return redirect()->route('authors.index')
                         ->with('success', 'Autor atualizado com sucesso!');
    }

    /**
     * Remove um autor (e, por cascata, seus livros).
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')
                         ->with('success', 'Autor excluído com sucesso!');
    }
}
