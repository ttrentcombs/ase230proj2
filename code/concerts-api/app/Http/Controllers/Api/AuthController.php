<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseApiController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:4',
        ]);

        User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json(['message' => 'user created'], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $data['username'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = bin2hex(random_bytes(16));
            $user->update(['token' => $token]);

            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'invalid login'], 401);
    }

    public function profile(Request $request)
    {
        $user = $this->requireUser($request);

        return response()->json([
            'id'         => $user->id,
            'username'   => $user->username,
            'created_at' => $user->created_at,
        ]);
    }

    public function indexUsers()
    {
        $users = User::select('id', 'username', 'created_at')
            ->orderByDesc('id')
            ->get();

        return response()->json($users);
    }
}
