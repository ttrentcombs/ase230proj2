<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    protected function currentUser(Request $request): ?User
    {
        $auth = $request->header('Authorization', '');
        if (stripos($auth, 'Bearer ') === 0) {
            $token = substr($auth, 7);
            return User::where('token', $token)->first();
        }
        return null;
    }

    protected function requireUser(Request $request): User
    {
        $user = $this->currentUser($request);
        if (!$user) {
            abort(response()->json(['error' => 'Unauthorized'], 401));
        }
        return $user;
    }
}
