@extends('layouts.app')
@section('title', 'Editar Livro')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Editar Livro</h2>
      <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Título</label>
          <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
          <label for="author_id" class="form-label">Autor</label>
          <select name="author_id" class="form-select" required>
            @foreach($authors as $author)
              <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                {{ $author->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="cover_image" class="form-label">Imagem da Capa</label>
          <input type="file" name="cover_image" class="form-control">
          @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa Atual" class="img-thumbnail mt-2" width="150">
          @endif
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Descrição</label>
          <textarea name="description" class="form-control" rows="4">{{ $book->description }}</textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Atualizar</button>
          <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
