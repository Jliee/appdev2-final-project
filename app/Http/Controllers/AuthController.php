<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request){

        $request->validated($request->all());

        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'password_confirmation' =>  $request->password_confirmation,
        ]);
        

        return $this->success([
            'user' => $User,
            'token' => $User->createToken($User->name . ' API Token')->plainTextToken
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());;

        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->error('','something is wrong, try again', 401);
        }

       $credentials = User::where('email', $request->email)->first();

       return $this->success([
        'user' => $credentials,
        'token' => $credentials->createToken($credentials->name. ' API Token')->plainTextToken
       ]);
    }



    public function logout(Request $request)
    {
        // Delete the current token using the request token method
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'You are now logged out and we took your token :P']);
    }
}


