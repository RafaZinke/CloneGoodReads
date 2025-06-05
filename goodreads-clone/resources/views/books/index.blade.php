@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="main-container">
    <h1 class="page-title">Livros</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('books.index') }}" class="d-flex w-50">
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Buscar por título ou autor...">
            <button class="btn btn-primary ms-2">Buscar</button>
        </form>
        <a href="{{ route('books.create') }}" class="btn btn-success">+ Novo Livro</a>
    </div>

    @if($books->count())
        <div class="card-container">
            @foreach($books as $book)
                <div class="card">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}"
                             class="card-img-top" alt="Capa do Livro">
                    @else
                        <img src="https://via.placeholder.com/220x180?text=Sem+Capa"
                             class="card-img-top" alt="Sem Capa">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text text-muted">{{ $book->author->name }}</p>
                        <div class="mt-auto button-group">
                            <a href="{{ route('books.show', $book) }}"
                               class="btn btn-info btn-sm btn-space">Ver</a>
                            <a href="{{ route('books.edit', $book) }}"
                               class="btn btn-warning btn-sm btn-space">Editar</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $books->withQueryString()->links() }}
        </div>
    @else
        <p class="text-center">Nenhum livro encontrado.</p>
    @endif
</div>

{{-- Inclua abaixo do conteúdo principal a div para exibir toast --}}
<div id="toast-container" class="toast-container"></div>
@endsection

@push('scripts')
<script>
    // Função de confirmação antes de excluir (basta se certificar de incluir SweetAlert2)
    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação não poderá ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>
@endpush
