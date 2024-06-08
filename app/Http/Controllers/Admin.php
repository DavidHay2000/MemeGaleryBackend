<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user!= null) {
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        }
        
        return response()->json(['message' => 'User not found'], 404);
    }

    public function AdminRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admin,username|max:255',
            'password' => 'required|min:6',
        ]);

        $admin = ModelsAdmin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($admin);
    }

    public function adimlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = ModelsAdmin::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json($user->id, 200);
    }

    
}
