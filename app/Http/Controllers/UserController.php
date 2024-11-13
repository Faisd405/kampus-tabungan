<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();

        return view('pages.users.index', compact('data'));
    }

    public function create()
    {
        return view('pages.users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|alpha_dash',
            'email' => 'required|email',
            'role' => 'required|in:staff,user',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $data['user'] = $user;

        return view('pages.users.form', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $user->id,
            'email' => 'required|email',
            'role' => 'required|in:staff,user',
            'password' => 'nullable|min:8',
        ]);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
