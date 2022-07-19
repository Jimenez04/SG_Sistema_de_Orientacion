<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
         * Registration Req
         */
        public function register(Request $request)
        {
           // dd($request);
            $this->validate($request, [
                'email' => 'required|email',
            ]);
            // dd($request);
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
    
            $token = $user->createToken('Laravel9PassportAuth')->accessToken;
   
            return response()->json(['token' => $token], 200);
        }
    
        /**
         * Login Req
         */
        public function login(Request $request)
        {
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];
    
            if (auth()->attempt($data)) {
                $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }
    
        public function userInfo() 
        {
    
        $user = auth()->user();
        
        return response()->json(['user' => $user], 200);
    
        }
}
