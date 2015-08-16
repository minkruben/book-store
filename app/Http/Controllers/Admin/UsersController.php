<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::latest('id')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->is_admin = $request->get('is_admin');
        $user->save();

        return redirect()->route('admin.users.edit', $user->id)->with('alert', 'User added!');
    }

    /**
     * Display resource search result.
     *
     * @param  string  $query
     * @return Response
     */
    public function search($query)
    {
        $users = User::where('email', 'LIKE', "%$query%")->paginate(10);

        return view('admin.users.index', compact('query', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = $request->get('is_admin');
        $user->update($request->all());

        return redirect()->route('admin.users.edit', $id)->with('alert', 'User updated!');
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
        $count = User::destroy($ids);
        if ($count > 1) {
            $alert = 'Users deleted!';
        }
        elseif ($count) {
            $alert = 'User deleted!';
        }

        return redirect()->route('admin.users.index')->with(compact('alert'));
    }
}
