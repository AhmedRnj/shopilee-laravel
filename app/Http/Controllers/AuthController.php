<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register ( Request $request){
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone' => 'sometimes',
            'country' => 'sometimes',
        ]);

        $user = User::where('email' , $data['email'])->first();
        if ( isset($user) ){
            return [ 'error' => 'Email already exsts' ];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'country' => $data['country'],
            'phone' => $data['phone'],
        ]);

        return $user;

    }
    public function login (Request $request){
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where(['email'=>$data['email'], 'password'=>$data['password']])->first();
        if(isset($user)){
            return $user;
        }
        return ['error' => 'Invalid credentials'];
    }
}
