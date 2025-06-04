@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
<div class="mt-4">
    <h2>Editar Autor</h2>

    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   id="name" value="{{ old('name', $author->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Biografia</label>
            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror"
                      id="bio">{{ old('bio', $author->bio) }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
