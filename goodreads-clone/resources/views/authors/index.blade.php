{{-- resources/views/authors/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Autores')

@section('content')
<div class="main-container">
    <h1 class="page-title">Autores</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <form method="GET" action="{{ route('authors.index') }}" class="d-flex w-50">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Buscar por nome..."
            >
            <button class="btn btn-primary ms-2">Buscar</button>
        </form>
        <a href="{{ route('authors.create') }}" class="btn btn-success">+ Novo Autor</a>
    </div>

    @if($authors->count())
        <table class="table table-striped table-centered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Bio</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ Str::limit($author->bio, 60) }}</td>
                        <td class="text-end">
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm btn-space">Editar</a>
                            <form
                                action="{{ route('authors.destroy', $author) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirmAuthorDelete(event)"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $authors->withQueryString()->links() }}
        </div>
    @else
        <p class="text-center">Nenhum autor encontrado.</p>
    @endif
</div>

{{-- Container para possíveis toasts --}}
<div id="toast-container" class="toast-container"></div>
@endsection

@push('scripts')
<script>
    function confirmAuthorDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação irá excluir o autor permanentemente.',
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
