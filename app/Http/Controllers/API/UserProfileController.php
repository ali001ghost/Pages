<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate
        ([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);

        return response()->json(['user'=>$user,'message' => 'User profile updated successfully']);
    }
    public function deleteAccount(Request $request)
{
    $user = $request->user();

    $user->delete();

    return response()->json(['message' => 'User account deleted successfully']);
}
}
