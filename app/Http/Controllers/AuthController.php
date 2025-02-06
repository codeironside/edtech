<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'firstName' => 'required|string',
            'surName' => 'required|string',
            'middleName'=>'string',
            'phoneNumber'=>'string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'firstName' => $fields['firstName'],
            'surName' => $fields['surName'],
            'middleName' => $fields['middleName'],
            'phoneNumber' => $fields['phoneNumber'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);


    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];

        
    }

    public function login(Request $request)
    {
        $fields = $request->validate([

            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email

        $user = User::where('email', $fields['email'])->first();
        //check password
        if (!$user|| !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);


    }
}
