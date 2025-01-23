<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class LaboranController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Laboran';
        return view('laboran.dashboard', compact('page'));
    }

    public function profile()
    {
        $user = User::findOrFail(auth()->id());
        $page = 'Profile Laboran';
        return view('laboran.profile', compact('page', 'user'));
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

        return redirect()->route('laboran.dashboard')->with('success', 'Profile updated successfully!');
    }
}
