<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passwords = Password::where('user_id', Auth::id())->get();
        return view('passwords.index', compact('passwords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('passwords.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        Password::create([
            'site_name' => $request->site_name,
            'username' => $request->username,
            'password' => $request->password, // Will be encrypted automatically
            'user_id' => Auth::id()
        ]);

        return redirect()->route('passwords.index')->with('success', 'Password saved securely.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('passwords.show', compact('password'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('passwords.edit', compact('password'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $password->update([
            'site_name' => $request->site_name,
            'username' => $request->username,
            'password' => $request->password
        ]);

        return redirect()->route('passwords.index')->with('success', 'Password updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $password->delete();

        return redirect()->route('passwords.index')->with('success', 'Password deleted successfully.');
    }

    public function reveal(Request $request, $id)
    {
        // Find the password entry belonging to the logged-in user
        $passwordEntry = Password::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        // Return the plain text password as JSON
        return response()->json([
            'password' => $passwordEntry->password
        ]);
    }
}
