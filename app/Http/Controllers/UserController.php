<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'password' => bcrypt($fields['password'])   
        ]);
        
        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json([
            'status' => true,
            'message' => $response
        ])->setStatusCode(201);
    }

    public function showAll() {
        return User::all();
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $response["user"] = $user->name;
            $response["token"] = $user->createToken('myAppToken')->plainTextToken;
            return response()->json($response, 200);
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect']
        ]);
    }
}
