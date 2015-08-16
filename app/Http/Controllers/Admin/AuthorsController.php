<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\AuthorRequest;
use App\Http\Controllers\Controller;

use App\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $authors = Author::latest('id')->paginate(10);

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AuthorRequest  $request
     * @return Response
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create($request->all());

        return redirect()->route('admin.authors.edit', $author->id)->with('alert', 'Author added!');
    }

    /**
     * Display resource search result.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        $authors = Author::where('name', 'LIKE', "%$query%")->paginate(10);

        return view('admin.authors.index', compact('query', 'authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AuthorRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());

        return redirect()->route('admin.authors.edit', $id)->with('alert', 'Author updated!');
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
        $count = Author::destroy($ids);
        if ($count > 1) {
            $alert = 'Authors deleted!';
        }
        elseif ($count) {
            $alert = 'Author deleted!';
        }

        return redirect()->route('admin.authors.index')->with(compact('alert'));
    }
}
