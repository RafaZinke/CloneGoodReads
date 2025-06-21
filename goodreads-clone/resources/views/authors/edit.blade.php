@extends('layouts.app')
@section('title', 'Editar Autor')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Editar Autor</h2>
      <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class="form-label">Nome do Autor</label>
          <input type="text" name="name" value="{{ $author->name }}" class="form-control" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Atualizar</button>
          <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
