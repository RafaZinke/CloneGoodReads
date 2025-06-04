@extends('layouts.app')

@section('title', 'Detalhes do Autor')

@section('content')
<div class="mt-4">
    <h2>Detalhes do Autor</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $author->name }}</h4>
            @if($author->bio)
                <p class="card-text">{{ $author->bio }}</p>
            @else
                <p class="card-text text-muted">Sem biografia cadastrada.</p>
            @endif
        </div>
    </div>

    <h4>Livros deste autor</h4>
    @if($books->count() > 0)
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4">
                    <div class="card mb-3">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/'.$book->cover_image) }}" class="card-img-top" alt="Capa">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">Ver</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>{{ $books->links() }}</div>
    @else
        <p>Nenhum livro cadastrado para este autor.</p>
    @endif

    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
