<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
            'street' => 'required|same:street',
            'neighborhood' => 'required|same:neighborhood',
            'number' => 'required|same:number',
            'city' => 'required|same:city',
            'estate' => 'required|same:estate',
            'postal_code' => 'required|same:postal_code'
        ]);

        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $address = new Address([
            'street'  => $request->street,
            'neighborhood' => $request->neighborhood,
            'number' => $request->number,
            'city'  => $request->city,
            'estate' => $request->estate,
            'postal_code' => $request->postal_code,
        ]);

        if ($user->save()) {
            $user->address()->save($address);
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            $login['success'] = true;
            $login['message'] = 'Successfully created user!';
            $login['accessToken'] = $token;
            return json_encode($login);
        } else {
            $login['success'] = false;
            $login['message'] = 'Provide proper details';
            return json_encode($login);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {

            $login['success'] = false;
            $login['message'] = 'Unauthorized';
            return json_encode($login);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        $login['success'] = true;
        $login['accessToken'] = $token;
        $login['token_type'] = 'Bearer';
        return json_encode($login);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $login['success'] = true;
        $login['message'] = 'Successfully logged out';
        return json_encode($login);
    }
}
