<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\AddUserRequest;

class UserController extends Controller
{
    //

    public function index()
    {

    return Inertia::render('user', [
            'users' => User::where('role','user')->paginate(5)
        ]);
    }

    public function store(AddUserRequest $request)
    {
        $post = $request->all();
        $post['role'] = 'user';
        User::create($post);
        return redirect()->back()->with('message', 'User created successfully!');
    }

    public function update(AddUserRequest $request)
    {
        if ($request->has('id')) {
            User::find($request->input('id'))->update($request->all());
            return redirect()->back()->with('message', 'User updated successfully!');
        }
    }

    public function delete(Request $request)
    {

        $request->has('id') ?
        User::find($request->input('id'))->delete() :
            redirect()->back()->with('errors', 'Somthing wrong.');
        return redirect()->back()->with('message', 'Deleted successfully!');
    }
}
