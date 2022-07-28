<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
         * Registration Req
         */
        public function User()
        {
            return $user = new User();
        }

        public function register(CreateUserRequest $request)
        {
             return $this->User()->newUser($request->validated());
        }
    
        /**
         * Login Req
         */
        public function login(LoginRequest $request)
        {
            return $this->User()->login($request->validated());
        }
    
        public function userInfo() 
        {
    
        $user = auth()->user();
        
        return response()->json(['user' => $user], 200);
    
        }
}
