<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->simplePaginate(10);
        return view('members.index', compact('users'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make('password'), // Default password
            'role' => 'user',
        ]);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function edit(User $user)
    {
        return view('members.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
