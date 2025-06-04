<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return request()->expectsJson()
            ? response()->json($users)
            : view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        if ($request->role_id == Role::where('name', 'writer')->first()->id) {
            \App\Models\Author::create(['user_id' => $user->id, 'bio' => 'Biografi default']);
        }

        return request()->expectsJson()
            ? response()->json($user, 201)
            : redirect()->route('users.index')->with('success', 'Pengguna dibuat.');
    }

    public function show(User $user)
    {
        $user->load('role');
        return request()->expectsJson()
            ? response()->json($user)
            : view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
        ]);

        return request()->expectsJson()
            ? response()->json($user)
            : redirect()->route('users.index')->with('success', 'Pengguna diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return request()->expectsJson()
            ? response()->json(['message' => 'Pengguna dihapus'])
            : redirect()->route('users.index')->with('success', 'Pengguna dihapus.');
    }
}
