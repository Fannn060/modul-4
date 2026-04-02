@extends('layouts.app')

@section('content')

<h3>Edit Book</h3>

<div class="card">
<div class="card-body">

<form action="{{ route('books.update',$book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kategori</label>
        <select name="category_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ $book->judul }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Penulis</label>
        <input type="text" name="penulis" value="{{ $book->penulis }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="{{ $book->tahun_terbit }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" value="{{ $book->stok }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Gambar Buku</label>
        @if($book->gambar)
            <div class="mb-2">
                <img src="{{ asset('images/' . $book->gambar) }}" width="100" class="img-thumbnail">
                <p class="text-muted small">Gambar saat ini</p>
            </div>
        @endif
        <input type="file" name="gambar" class="form-control" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

@endsection