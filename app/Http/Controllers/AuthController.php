<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request )
    {
        \->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        \ = User::where('username', \->username)->first();

        if (!\ || !Hash::check(\->password, \->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'role' => \->role,
                'nama' => \->nama_lengkap,
            ]
        ]);
    }
}
