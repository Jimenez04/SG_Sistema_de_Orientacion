<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\change_password_admin__request;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\CreateUserFromAdminRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
         * Registration Req
         */
        public function User()
        {
            return $user = new User();
        }

           /**
        * @OA\Post(
        * path="/api/register",
        * operationId="Register",
        * tags={"Registrar"},
        * summary="Registro de usuario",
        * description="Acá se registran los usuarios de la UCR sede Guanacaste",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"cedula", "nombre1", "nombre2", "apellido1", "apellido2", "fecha_Nacimiento", "sexo_id", "email", "password_", "c_password"},
        *               @OA\Property(property="cedula", type="text"),
        *               @OA\Property(property="nombre1", type="text"),
        *               @OA\Property(property="nombre2", type="text"),
        *               @OA\Property(property="apellido1", type="text"),
        *               @OA\Property(property="apellido2", type="text"),
        *               @OA\Property(property="fecha_Nacimiento", type="date", format="date"),
        *               @OA\Property(property="sexo_id", type="integer"),


        *                @OA\Property(property="email", type="email" , format="email", example="test@ucr.ac.cr.com"),
        *               @OA\Property(property="password_", type="password"),
        *               @OA\Property(property="c_password", type="password")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Register Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function register(CreateUserRequest $request) //CreateUserRequest
        {
            return $this->User()->newUser($request->validated());
        }

        public function registerUserFromAdmin(CreateUserFromAdminRequest $request)
        {
             return $this->User()->newUser($request->validated(), $request->validated('is_admin'));
        }
    
        /**
        * @OA\Post(
        * path="/api/login",
        * operationId="login",
        * tags={"Login"},
        * summary="Login de usuario",
        * description="Acá se loguea el usuario de la UCR sede Guanacaste",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"email", "password_"},
        *               @OA\Property(property="email", type="email" , format="email", example="test@ucr.ac.cr.com"),
        *               @OA\Property(property="password_", type="password")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function login(LoginRequest $request)
        {
            return $this->User()->login($request->validated());
        }

        public function change_password(changePasswordRequest $request)
        {
            return $this->User()->change_password('Estudiante',$request->validated());
        }
        public function change_password_admin(change_password_admin__request $request)
        {
            return $this->User()->change_password('Administrador', $request->validated());
        }
        public function forget_account(LoginRequest $request)
        {
            return $this->User()->login($request->validated());
        }
    
        public function userInfo() 
        {
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
        }
}
