@extends('layouts.app')
@section('title', 'Adicionar Autor')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Adicionar Novo Autor</h2>
      <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nome do Autor</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Salvar</button>
          <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
