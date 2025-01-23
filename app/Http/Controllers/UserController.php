<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'admin.user.index',
            ['page' => 'Data User', 'users' => User::all(), 'no' => 1]
        );
    }

    public function dashboard()
    {
        $page = 'Dashboard User';
        return view('user.dashboard', compact('page'));
    }

    public function profile()
    {
        $user = User::findOrFail(auth()->id());
        $page = 'Profile User';
        return view('user.profile', compact('page', 'user'));
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user = User::findOrFail(auth()->id());

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 'Tambah Data User';
        return view('admin.user.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $priority = match ($request->role) {
            'admin' => 1,
            'laboran' => 2,
            'user' => 3,
            default => null,
        };

        User::create(array_merge(
            $request->validated(),
            ['priority' => $priority]
        ));

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $page = 'Detail Data User';
        return view('admin.user.show', compact('user', 'page'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $page = 'Edit Data User';
        return view('admin.user.edit', compact('page', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
