<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
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
    

    public function newUser($request){
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
                                    $persona->addEmail($request['cedula'], $request['email']); //En caso que sea un nuevo usuario
                                $user->save();
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
                            $this->scope = $userRole->role;
                        }
                            $token = $user->createToken($user->email.'-'.now(), [$this->scope]);
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
