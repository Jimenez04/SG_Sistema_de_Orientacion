<?php

namespace App\Models;

use App\Events\StudentSaved;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                        }         
                        StudentSaved::dispatch($request);
                            if($is_Admin){
                                return response()->json([
                                    "status" => true,
                                    "Message" => "El usuario fue creado correctamente",
                                    ],200);
                            }
                                return response()->json([
                                    "status" => true,
                                    "token" => $user->createToken('Laravel9PassportAuth')->accessToken,
                                    ],200);
        }catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage(),
                ],500);
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
                            $token = $user->createToken($user->email.'-'.now(), [$user->scope]);
                            return response()->json($token->accessToken, 200);
                } else {
                    return response()->json(['error' => 'Unauthorised'], 401); //Usuario o contraseña incorrectos o no existe
                }
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
