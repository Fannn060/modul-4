@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Kategori</h3>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->nama_kategori }}</td>
                    <td>
                        <span class="badge bg-info">{{ $category->books_count }}</span>
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('categories.destroy', $category->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus kategori ini?')">
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