<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
       
        $data = [];

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
      

        if (Auth::attempt(($credentials))) {
            
            $data['user'] = Auth::user();
            $data['token'] = Auth::user()->createToken('twitter-token')->accessToken;

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
            
        }

        about(401);
    }
}
