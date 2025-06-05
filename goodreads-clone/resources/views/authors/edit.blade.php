{{-- resources/views/authors/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
<div class="main-container">
    <h1 class="page-title">Editar Autor</h1>

    <div class="form-wrapper">
        <form
            id="author-form"
            action="{{ route('authors.update', $author) }}"
            method="POST"
            class="w-75"
        >
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $author->name) }}"
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
                >{{ old('bio', $author->bio) }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

{{-- Container para toasts --}}
<div id="toast-container" class="toast-container"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('author-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Confirmar atualização',
            text: 'Deseja realmente atualizar este autor?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim, atualizar',
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
