<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::parseToken()->invalidate();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to logout, user not authenticated'], 401);
        }
    }

    public function isAdmin(Request $request)
    {
        $token = $request->bearerToken(); 

        $decodedToken = JWTAuth::setToken($token)->getPayload();
        $userId = $decodedToken->get('sub');
        $user = User::find($userId);

        if (!$user || !$user->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['message' => 'User is Admin'], 200);
    }
}