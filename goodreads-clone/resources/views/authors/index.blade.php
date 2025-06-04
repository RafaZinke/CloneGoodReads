@extends('layouts.app')

@section('title', 'Autores')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
    <h2>Autores</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">+ Novo Autor</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Biografia</th>
            <th width="150">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>{{ Str::limit($author->bio, 50) }}</td>
                <td>
                    <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Deseja mesmo excluir este autor?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhum autor encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div>
    {{ $authors->links() }}
</div>
@endsection
