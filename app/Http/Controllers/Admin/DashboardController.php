<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\User;

class DashboardController extends Controller
{
    /**
     * Display a summery.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::all()->count();
        $users = User::all()->count();

        return view('admin.index', compact('books', 'users'));
    }
}
