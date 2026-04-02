<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
    $query = Book::with('category');

    if ($request->judul) {
        $query->where('judul', 'like', '%' . $request->judul . '%');
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $books = $query->get();
    $categories = Category::all();
    $totalBooks = Book::count();
    $booksPerCategory = Category::withCount('books')->get();

    return view('books.index', compact('books', 'categories', 'totalBooks', 'booksPerCategory'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'category_id'  => 'required|numeric',
        'judul'        => 'required',
        'penulis'      => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok'         => 'required|numeric',
        'gambar'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('images'), $namaGambar);
        $data['gambar'] = $namaGambar;
    }

    Book::create($data);

    return redirect()->route('books.index')
            ->with('success', 'Data berhasil ditambahkan');
}
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
{
    $request->validate([
        'category_id'  => 'required|numeric',
        'judul'        => 'required',
        'penulis'      => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok'         => 'required|numeric',
        'gambar'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama kalau ada
        if ($book->gambar && file_exists(public_path('images/' . $book->gambar))) {
            unlink(public_path('images/' . $book->gambar));
        }
        $gambar = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('images'), $namaGambar);
        $data['gambar'] = $namaGambar;
    } else {
        unset($data['gambar']);
    }

    $book->update($data);

    return redirect()->route('books.index')
            ->with('success', 'Data berhasil diupdate');
}
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                ->with('success','Data berhasil dihapus');
    }
}