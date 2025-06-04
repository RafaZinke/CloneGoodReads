@extends('layouts.app')

@section('title', 'Detalhes do Livro')

@section('content')
<div class="mt-4">
    <h2>Detalhes do Livro</h2>

    <div class="card mb-4">
        @if($book->cover_image)
            <img src="{{ asset('storage/'.$book->cover_image) }}" class="card-img-top" alt="Capa">
        @endif
        <div class="card-body">
            <h4 class="card-title">{{ $book->title }}</h4>
            <p class="card-text"><strong>Autor:</strong> {{ $book->author->name }}</p>
            @if($book->description)
                <p class="card-text">{{ $book->description }}</p>
            @else
                <p class="card-text text-muted">Sem descrição cadastrada.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
