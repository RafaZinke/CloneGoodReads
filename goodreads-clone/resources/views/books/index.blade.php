@extends('layouts.app')
@section('title', 'Lista de Livros')

@section('content')
  <div class="text-center mb-4">
    <h1 class="display-5">Livros</h1>
    <a href="{{ route('books.create') }}" class="btn btn-success mt-2">Adicionar Novo Livro</a>
  </div>

  <div class="row justify-content-center">
    @foreach($books as $book)
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://via.placeholder.com/150x200' }}" class="card-img-top" alt="Capa do Livro">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text text-muted">{{ $book->author->name }}</p>
            <div class="mt-auto">
              <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Editar</a>
              <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
