<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show($id)
    {
        return response()->json(Book::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->only(['title', 'author']));

        return response()->json($book);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(['message' => 'Book deleted']);
    }
}
