<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = new User;
        $user->role = $request->input("role");
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        $user->nohp = $request->input("nohp");
        $user->email = $request->input("email");
        $user->nim = $request->input("nim");
        $user->password = Hash::make($request->input("password"));
        $user->save();
        return response($user, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ["error" => "Email or password is not matched"];
            // throw ValidationException::withMessages([
            //     'username' => ['The provided credentials are incorrect.'],
            // ]);
        }
        if ($user->role == "admin") {
            $token = $user->createToken('user', ["admin"])->plainTextToken;
            $role = $user->role;
        } else {
            $token = $user->createToken('user', ["teknisi"])->plainTextToken;
            $role = $user->role;
        }
        $response = [
            'user' => $user,
            'token' => $token,
            'role' => $role
        ];

        return response($response, 201);

        // $user = User::where('username', $request->username)->first();
        // if (!$user || Hash::check($request->password, $user->password)) {
        //     return ["error" => "Email or password is not matched"];
        // }
        // return $user;
    }

    public function logout(Request $request)
    {
        // $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        // $request->user()->tokens()->where('token', $request->token)->delete();
        return response('Loggedout', 200);
    }

    public function update(Request $request)
    {
        $id = Auth()->user()->id;
        User::where('id', $id)->update([
            'name' => $request->input("name"),
            "username" => $request->input("username"),
            "nohp" => $request->input("nohp"),
            "email" => $request->input("email"),
            "nim" => $request->input("nim"),
            "password" => Hash::make($request->input("password"))
        ]);
        return response(201);
    }
}
