<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if ($token) 
        {

                $user = Auth::user();
                session(['user' => $user]);
                    if (Auth::user()->role_id == 2) 
                    {
                        return response()->json([
                            'message' => 'You are Not Admin',
                        ], 401);
                    } 
                    elseif(Auth::user()->role_id == 1) {

                    return response()->json([
                        'user' => $user,
                        'authorization' => [
                        'token' => $token,
                        'type' => 'bearer',
                        ]
                    ]);
                }
        }else{
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);

        }

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'phone_number' => 'required|string',

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' =>  $request->age,
            'gender' =>  $request->gender,
            'phone_number' => $request->phone_number,
            'role_id'=> 1 ,
        ]);

        $token = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            ['message' => 'Successfully logged out'],
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'Admin' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
