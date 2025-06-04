@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
<div class="mt-4">
    <h2>Editar Livro</h2>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                   id="title" value="{{ old('title', $book->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
                <option value="">Selecione...</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                      id="description">{{ old('description', $book->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Exibir capa atual, se existir --}}
        @if($book->cover_image)
            <div class="mb-3">
                <p>Capa atual:</p>
                <img src="{{ asset('storage/'.$book->cover_image) }}" alt="Capa Atual" class="img-fluid mb-2" style="max-height: 200px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="cover_image" class="form-label">Nova Capa (opcional)</label>
            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
                   id="cover_image">
            @error('cover_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
