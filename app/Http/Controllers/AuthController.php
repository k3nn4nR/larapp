<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('secret')->plainTextToken;
            return response()->json(['user' => auth()->user(), 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }



    public function token()
    {
        if(!auth()->user())
            return response()->json(['error' => 'Unauthorised'], 401);
        $token = auth()->user()->createToken('secret')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
}
