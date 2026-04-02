@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Koleksi Buku Kami 📚</h3>
    <a href="{{ route('books.index') }}" class="btn btn-outline-dark">Lihat Mode Tabel</a>
</div>

<div class="row">
    @foreach($books as $book)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            @if($book->gambar)
                <img src="{{ asset('images/' . $book->gambar) }}"
                     class="card-img-top"
                     style="height: 200px; object-fit: cover;">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center"
                     style="height: 200px;">
                    <span class="text-white">Tidak ada gambar</span>
                </div>
            @endif

            <div class="card-body">
                <h6 class="card-title fw-bold">{{ $book->judul }}</h6>
                <p class="card-text mb-1">
                    🖊️ {{ $book->penulis }}
                </p>
                <p class="card-text mb-2">
                    📅 Tahun: {{ $book->tahun_terbit }}
                </p>
            </div>

            <div class="card-footer">
                <span class="btn btn-success w-100">
                    Stok Tersedia: {{ $book->stok }}
                </span>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection