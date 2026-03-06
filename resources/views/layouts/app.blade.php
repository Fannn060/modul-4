<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Perpustakaan</span>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->is('books*') ? 'active' : '' }}" 
               href="{{ route('books.index') }}">Buku</a>
            <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" 
               href="{{ route('categories.index') }}">Kategori</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
```


