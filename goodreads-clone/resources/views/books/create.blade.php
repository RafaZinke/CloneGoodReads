@extends('layouts.app')

@section('title', 'Criar Livro')

@section('content')
<div class="main-container">
    <h1 class="page-title">Criar Novo Livro</h1>

    <div class="form-wrapper">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"
              id="book-form" class="w-75">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">Autor</label>
                <select name="author_id" id="author_id"
                        class="form-select @error('author_id') is-invalid @enderror" required>
                    <option value="">Selecione...</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                                {{ old('author_id') == $author->id ? 'selected' : '' }}>
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
                <textarea name="description" id="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Capa (imagem)</label>
                <input type="file" name="cover_image" id="cover_image"
                       class="form-control @error('cover_image') is-invalid @enderror"
                       accept="image/*">
                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

{{-- Toast de confirmação --}}
<div id="toast-container" class="toast-container"></div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('book-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Exibe sweetalert de confirmação com a imagem de capa antes de enviar
            const fileInput = document.getElementById('cover_image');
            let imageUrl = null;

            if (fileInput.files && fileInput.files[0]) {
                // Cria um objeto URL para pré-ver a imagem selecionada
                imageUrl = URL.createObjectURL(fileInput.files[0]);
            }

            Swal.fire({
                title: 'Confirmação',
                text: 'Deseja realmente cadastrar este livro?',
                icon: 'question',
                imageUrl: imageUrl,            // mostra a pré-visualização da capa (se houver)
                imageHeight: 200,
                showCancelButton: true,
                confirmButtonText: 'Sim, cadastrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Se confirmar, envia o formulário normalmente
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
