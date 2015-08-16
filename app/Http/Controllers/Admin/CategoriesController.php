<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('admin.categories.edit', $category->id)->with('alert', 'Category added!');
    }

    /**
     * Display resource search result.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        $categories = Category::where('name', 'LIKE', "%$query%")->paginate(10);

        return view('admin.categories.index', compact('query', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories.edit', $id)->with('alert', 'Category updated!');
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
        $count = Category::destroy($ids);
        if ($count > 1) {
            $alert = 'Categories deleted!';
        }
        elseif ($count) {
            $alert = 'Category deleted!';
        }

        return redirect()->route('admin.categories.index')->with(compact('alert'));
    }
}
