@extends('layouts.app')

@section('title', 'Criar Autor')

@section('content')
<div class="mt-4">
    <h2>Criar Novo Autor</h2>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Biografia</label>
            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror"
                      id="bio">{{ old('bio') }}</textarea>
            @error('bio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
