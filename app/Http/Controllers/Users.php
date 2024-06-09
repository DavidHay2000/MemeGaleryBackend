<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
   
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid user'], 402);
        }

        return response()->json($user->id, 200);
    }

    
     /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find($user);
        if ($user!= null) {
            return $user;
        }
        return response()->json(['message' => 'Not found'], 404);
    }
    
        
}

