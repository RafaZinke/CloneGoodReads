@extends('layouts.app')
@section('title', 'Lista de Autores')

@section('content')
  <div class="text-center mb-4">
    <h1 class="display-5">Autores</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-success mt-2">Adicionar Novo Autor</a>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table table-striped text-center shadow-sm rounded">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($authors as $author)
            <tr>
              <td>{{ $author->id }}</td>
              <td>{{ $author->name }}</td>
              <td>
                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
