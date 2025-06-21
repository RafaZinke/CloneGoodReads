<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'CloneGoodReads')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-light text-dark">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('books.index') }}">CloneGoodReads</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Livros</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('authors.index') }}">Autores</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">
    @yield('content')
  </main>

  <footer class="text-center py-4">
    <small>&copy; {{ date('Y') }} CloneGoodReads</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
