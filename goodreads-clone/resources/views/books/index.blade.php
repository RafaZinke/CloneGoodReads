@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
    <h2>Livros</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Novo Livro</a>
</div>

{{-- Formulário de busca --}}
<form method="GET" action="{{ route('books.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Buscar por título ou autor...">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
</form>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-3">
            <div class="card mb-4">
                @if($book->cover_image)
                    <img src="{{ asset('storage/'.$book->cover_image) }}" class="card-img-top" alt="Capa">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text text-muted">{{ $book->author->name }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Deseja mesmo excluir este livro?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="ms-3">Nenhum livro encontrado.</p>
    @endforelse
</div>

<div>
    {{ $books->withQueryString()->links() }}
</div>
@endsection
