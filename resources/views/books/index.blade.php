@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Informasi Jumlah Data --}}
<div class="alert alert-info">
    <strong>Total Data Book: {{ $totalBooks }}</strong> | Per Kategori:
    @foreach($booksPerCategory as $cat)
        <span class="badge bg-dark">{{ $cat->nama_kategori }}: {{ $cat->books_count }}</span>
    @endforeach
</div>

{{-- Form Pencarian & Filter --}}
<form method="GET" action="{{ route('books.index') }}" class="mb-3">
    <div class="row g-2">
        <div class="col-md-5">
            <input type="text" name="judul" class="form-control"
                   placeholder="Cari judul buku..."
                   value="{{ request('judul') }}">
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100">Cari & Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Cover</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $key => $book)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>
                        <span class="badge bg-info">{{ $book->stok }}</span>
                    </td>
                    <td>
                        @if($book->gambar)
                            <img src="{{ asset('images/' . $book->gambar) }}"
                                 width="60" class="img-thumbnail">
                        @else
                            <span class="badge bg-secondary">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit',$book->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('books.destroy',$book->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection