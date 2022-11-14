<?php

namespace App\Models;

use App\Events\StudentSaved;
use App\Events\User_ForgetAccount;
use App\Events\UserValidate;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
    ];
    
    protected $email;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function newUser($request, $is_Admin = false){
        try {
            if($this->validate_Email($request['email'])){
                return response()->json([
                    "status" => false,
                    "error" => "El Email ya se encuentra en uso",
                    ],409);
                }
                $user = User::make([
                    'email' => $request['email'],
                    'password' => bcrypt($request['password_'])
                ]);
                    $persona = new Persona();
                    $response = $persona->newperson($request);
                    $response = json_decode($response->getContent());

                        if(!$response->status){
                            return response()->json($response);
                        }else if($response->status == 3 || $response->status){
                                $persona = Persona::find($request['cedula']);
                                    $user->add_Rol(2);
                                    $user->addperson($persona);

                                $user->save();

                                StudentSaved::dispatch($request);

                                if($is_Admin){
                                    return response()->json([
                                        "status" => true,
                                        "Message" => "El usuario fue creado correctamente",
                                        ],200);
                                }
                                    return response()->json([
                                        "status" => true,
                                        "token" =>$this->generatetoken($request),
                                        ],200);
                        }         
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function generatetoken($request){
        $data = $this->generatedataLogin($request);
                    if (auth()->attempt($data)) {
                        $user = Auth::user();
                        $userRole = $user->Role()->first();
                            if ($userRole) {
                                $user->scope = $userRole->role;
                            }
                                $token = $user->createToken($user->email.'-'.now(), [$user->scope]);
                                return $token->accessToken;
        }
    }

    public function login($request){
        try{
            $data = $this->generatedataLogin($request);
                if (auth()->attempt($data)) {
                    $user = Auth::user();
                    $userRole = $user->Role()->first();
                        if ($userRole) {
                            $user->scope = $userRole->role;
                        }
                            $this->revokeAllTokenUser($request['email']);
                            $token = $user->createToken($user->email.'-'.now(), [$user->scope]);
                            return response()->json($token->accessToken, 200);
                } else {
                    return response()->json(['status' => "false", 'error' => 'Verifique los campos'], 401); //Usuario o contraseña incorrectos o no existe
                }
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function logOut()
        {
            try{
                $user = Auth::user()->token();
                $user->revoke();
                return response()->json(["status" => true, 'message' => 'Ha salido de sesión'], 200);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
        }
        }
        
    public function forget_Account($request)
    {
        try{
            $persona = new Persona();
                if($this->validate_Email($request['email'])
                 && $persona->validate_cedula_DB($request['cedula'])){
                     $user = User::where('email', $request['email'])->first();
                    if($user->Persona->cedula == $request['cedula'] && $user->role->role == "Estudiante" && ($persona->find_student($request['cedula']))->carnet == $request['carnet']){
                       return $this-> generic_Password($user, $request);
                    }else if($user->Persona->cedula == $request['cedula'] 
                    && $user->role->role == "Administrador" && ('45WeOELl2x') == $request['carnet']) {
                        return $this-> generic_Password($user, $request);
                    }
                    return response()->json(['status' => false, 'message' => 'Error al realizar la solicitud'], 400);
                }
                return response()->json(['status' => false,'message' => 'Los datos son erróneos'], 400);
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function generic_Password($user, $request){
        try{
            $password_random = Str::random(10);
                $data = ['password' => $password_random,
                            'time' => Carbon::now(), 
                            'email' => $request['email']];
                User_ForgetAccount::dispatch($data);
            $user->password = bcrypt($password_random);
            $user->save();
            $this->revokeAllTokenUser($request['email']);
            return response()->json(['status' => true,'message' => 'Solicitud realizada con éxito'], 200);
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function revokeAllTokenUser($email){
        try{
            $user = User::where('email', $email)->first();
            DB::table('oauth_access_tokens')->where('user_id', $user->id)->update(array('revoked' => '1'));
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function change_password($user, $request){
        try{
            if($request['email'] == Auth::user()['email'] || $user == "Administrador"){
                $user = User::where('email', $request['email'])->first();
                    if($user instanceof User){
                            if($this->passwordCorrect($request['old_password_']) || $user == "Administrador"){
                                $user->password = bcrypt($request['new_password_']);
                                $user->save();
                                return response()->json([
                                    "status" => true,
                                    "Message" => "La contraseña fue actualizada correctamente",
                                ],200);
                            }else{
                                return response()->json([
                                    "status" => false,
                                    "error" => "La contraseña actual es incorrecta",
                                ],404);
                            }
                        }else{
                            return response()->json([
                            "status" => false,
                            "error" => "El usuario no existe",
                        ],404);
                    }
            }else{
                return response()->json([
                    "status" => false,
                    "error" => "No tiene permisos para editar este usuario",
                ],404);
            }
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    private function passwordCorrect($oldpassword)
    {
        return Hash::check($oldpassword, Auth::user()->password, []);
    }

    private function generatedataLogin($request){
        return [
            'email' => $request['email'],
            'password' => $request['password_']
        ];
    }

    public function delete_user($id) {
        try{
            $persona = new Persona();
            $isnumeric = json_decode($this->verificarID($id)->getContent());
                if(!$isnumeric->status){
                    return response()->json($isnumeric,400);
                }
                $validated =  $this->admin_validatedRol();
                    if($validated['status']){ 
                        $data = $this->validate_user($id, true);
                            if(!$data){
                                return response()->json(['message' => "El usuario no existe"],400);
                            }
                                $user = User::find($id);
                                if($user->Role->role != "Administrador"){
                                    $user->delete();
                                    return response()->json(['message'=> "Eliminado con exito", 'data' => $user],200);
                                }else{
                                    return response()->json(['message'=> "Este usuario no puede ser eliminado"],400);
                                }
                        
                    }
                return response()->json($validated,403);
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
        }
    }

    public function email_verified_at($id)
        {
            try{
                $isnumeric = json_decode($this->verificarID($id)->getContent());
                    if(!$isnumeric->status){
                        return response()->json($isnumeric,400);
                    }
                    $validated =  $this->admin_validatedRol();
                        if($validated['status']){ 
                            $data = $this->validate_user($id, true);
                                if(!$data){
                                    return response()->json(['message' => "El usuario no existe"],400);
                                }
                                    $user = User::find($id);
                                    if($user->Role->role != "Administrador"){
                                        if($user->email_verified_at != null){
                                            return response()->json(['message'=> "El usuario ya se encuentra validado"], 409);
                                        }
                                        $user->email_verified_at = Carbon::now();
                                        $user->save();
                                        UserValidate::dispatch($user);
                                        return response()->json(['message'=> "El usuario ha sido verificado con éxito ", 'data' => $user],200);
                                    }else{
                                        return response()->json(['message'=> "Este usuario no puede ser actualizado"],400);
                                    }
                        }
                    return response()->json($validated,403);
            }catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    "error" => $th->getMessage(),
                    ],500);
            }
        }

    private function validate_user($id){
        $data = User::where('id', $id)->exists();
                return $data;
    }

    public function admin_validatedRol(){
        if("Administrador" == Auth::user()->role->role){
            return  ['status'=>true];
        }else{
            return [
                "status" => false,
                "error" => "No tiene permisos para gestionar esta persona",
                    ];
        }
    }

    public function verificarID($id){
        if(!is_numeric($id)){
            return response()->json([
                "status" => false,
                "error" => "El id debe ser un número",
            ],400);
        }else{return response()->json([
            "status" => true,
        ],200);}
    }

    private function add_Rol($id_rol) {
        $rol = Role::find($id_rol);
        return $rol->add_User($this);
    }

    private function validate_Email($email){
        return User::where('email', $email)->exists();
    }

    public function addperson($persona){
        $this->Persona()->save($persona);
    }
    
    public function Persona()
    {
        return $this->hasOne(Persona::class, 'user_id', 'id');
    }

    public function Role() {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

}
