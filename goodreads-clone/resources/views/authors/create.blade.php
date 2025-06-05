{{-- resources/views/authors/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Criar Autor')

@section('content')
<div class="main-container">
    <h1 class="page-title">Criar Novo Autor</h1>

    <div class="form-wrapper">
        <form
            id="author-form"
            action="{{ route('authors.store') }}"
            method="POST"
            class="w-75"
        >
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biografia</label>
                <textarea
                    name="bio"
                    id="bio"
                    class="form-control @error('bio') is-invalid @enderror"
                    rows="4"
                >{{ old('bio') }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

{{-- Container para toasts, caso queira exibir depois --}}
<div id="toast-container" class="toast-container"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('author-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Confirmar cadastro',
            text: 'Deseja realmente cadastrar este autor?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim, cadastrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
