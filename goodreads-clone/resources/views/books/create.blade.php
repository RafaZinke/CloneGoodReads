@extends('layouts.app')
@section('title', 'Adicionar Livro')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Adicionar Novo Livro</h2>
      <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Título</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="author_id" class="form-label">Autor</label>
          <select name="author_id" class="form-select" required>
            @foreach($authors as $author)
              <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="cover_image" class="form-label">Imagem da Capa</label>
          <input type="file" name="cover_image" class="form-control">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Descrição</label>
          <textarea name="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Salvar</button>
          <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
