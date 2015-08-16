<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

use App\Author;
use App\Category;
use App\Book;

use Image;
use File;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::latest('id')->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $authors = Author::orderBy('name')->lists('name', 'id');
        $categories = Category::orderBy('name')->lists('name', 'id');

        return view('admin.books.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookRequest  $request
     * @return Response
     */
    public function store(BookRequest $request)
    {
        $category = Category::findOrFail($request->get('category_id'));
        $book = $category->books()->save(Book::create($request->all()));
        foreach ($request->get('authors') as $id) {
            $author = Author::findOrFail($id);
            $book->authors()->save($author);
        }
        $image = $request->file('image');
        if (isset($image)) {
            $name = $book->id.'.'.$image->getClientOriginalExtension();
            if ($image->move(public_path().'/images/books', $name)) {
                Image::make(public_path().'/images/books/'.$name)->resize(180, 240)->save(public_path().'/images/books/thumbnails/'.$name);
                $book->image = $name;
            }
        }
        $book->save();

        return redirect()->route('admin.books.edit', $book->id)->with('alert', 'Book added!');
    }

    /**
     * Display resource search result.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        $books = Book::where('title', 'LIKE', "%$query%")->paginate(10);

        return view('admin.books.index', compact('query', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::orderBy('name')->lists('name', 'id');
        $selected = $book->authors()->lists('id')->all();
        $categories = Category::orderBy('name')->lists('name', 'id');

        return view('admin.books.edit', compact('book', 'authors', 'selected', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $category = Category::findOrFail($request->get('category_id'));
        $book->category()->associate($category);
        $image = $request->file('image');
        if (isset($image)) {
            if (isset($book->image)) {
                File::delete(public_path().'/images/books/thumbnails/'.$book->image);
                File::delete(public_path().'/images/books/'.$book->image);
            }
            $name = $book->id.'.'.$image->getClientOriginalExtension();
            if ($image->move(public_path().'/images/books', $name)) {
                Image::make(public_path().'/images/books/'.$name)->resize(180, 240)->save(public_path().'/images/books/thumbnails/'.$name);
                $book->image = $name;
            }
        }
        $book->update($request->all());
        $book->authors()->detach();
        foreach ($request->get('authors') as $authorId) {
            $author = Author::findOrFail($authorId);
            $book->authors()->save($author);
        }

        return redirect()->route('admin.books.edit', $id)->with('alert', 'Book updated!');
    }

    /**
     * Remove resource from storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $ids = explode(',', $request->get('checked'));
        $count = 0;
        foreach ($ids as $id) {
            $book = Book::findOrFail($id);
            if (isset($book->image)) {
                File::delete(public_path().'/images/books/thumbnails/'.$book->image);
                File::delete(public_path().'/images/books/'.$book->image);
            }
            $book->delete();
            $count++;
        }
        if ($count > 1) {
            $alert = 'Books deleted!';
        }
        elseif ($count) {
            $alert = 'Book deleted!';
        }

        return redirect()->route('admin.books.index')->with(compact('alert'));
    }
}
