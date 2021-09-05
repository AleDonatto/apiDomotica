<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ApiController extends Controller
{
    //
    public function LoginUser(Request $request){

        /*$validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);*/ 

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            
            $user = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('email', $request->email)
            ->first();
            
            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        }

        return response()->json([
            'status' => 204,
            'message' => 'The provided credentials do not match our records.'
        ],204);

    }
}
