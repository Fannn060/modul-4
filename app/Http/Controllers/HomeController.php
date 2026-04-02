<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('home', compact('books'));
    }
}