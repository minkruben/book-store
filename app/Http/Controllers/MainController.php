<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Author;
use App\Category;
use App\Book;

use Cart;

class MainController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $books = Book::latest('id')->paginate(18);

        return view('index', compact('categories', 'books'));
    }

    /**
     * Display search result.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        $categories = Category::orderBy('name')->get();
        $books = Book::where('title', 'LIKE', "%$query%")->paginate(18);

        return view('index', compact('categories', 'query', 'books'));
    }

    /**
     * Display the specified author.
     *
     * @param  int  $id
     * @return Response
     */
    public function author($id)
    {
        $categories = Category::orderBy('name')->get();
        $author = Author::findOrFail($id);
        $books = $author->books()->paginate(10);

        return view('author', compact('categories', 'author', 'books'));
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function category($id)
    {
        $categories = Category::orderBy('name')->get();
        $category = Category::findOrFail($id);
        $name = $category->name;
        $books = $category->books()->paginate(18);

        return view('index', compact('categories', 'name', 'books'));
    }

    /**
     * Display the specified book.
     *
     * @param  int  $id
     * @return Response
     */
    public function book($id)
    {
        $categories = Category::orderBy('name')->get();
        $book = Book::findOrFail($id);

        return view('book', compact('categories', 'book'));
    }

    /**
     * Display cart content.
     *
     * @return Response
     */
    public function cart()
    {
        $categories = Category::orderBy('name')->get();

        return view('cart', compact('categories'));
    }

    /**
     * Add the specified book to cart.
     *
     * @param  int  $id
     * @return Response
     */
    public function add($id)
    {
        $book = Book::findOrFail($id);
        Cart::add($book->id, $book->title, 1, $book->price, ['image' => $book->image]);

        return redirect()->back();
    }
}
