<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\newPAI_request;
use App\Http\Requests\resumePAI_request;
use App\Http\Requests\updateStatusPAI_request;
use App\Models\Plan_De_Accion_Individual;
use App\Models\Preguntas_Valoracion;
use Dotenv\Validator;
use Illuminate\Http\Request;

class SolicitudesPAIController extends Controller
{
    public function solicitudPAI()
    {
        return $solicitud = new Plan_De_Accion_Individual();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->solicitudPAI()->getAll('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, newPAI_request $PAI)
    {
        $cedula = $request->cedula == null ? null : $request->cedula;
        return $this->solicitudPAI()->newPAI($cedula, $PAI->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->solicitudPAI()->get($id);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $numsolicitud
     * @return \Illuminate\Http\Response
     */
    public function showForCarnet($carnet)
    {
        return $this->solicitudPAI()->getForCarnet($carnet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $numsolicitud
     * @return \Illuminate\Http\Response
     */
    public function updateState($numSolicitud, updateStatusPAI_request $request)
    {
        return $this->solicitudPAI()->updateStatus($numSolicitud, $request->validated()); //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $numsolicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy($numsolicitud)
    {
        return $this->solicitudPAI()->eliminarsolicitud($numsolicitud);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $numsolicitud
     * @return \Illuminate\Http\Response
     */
    public function resume($numsolicitud, resumePAI_request $request)
    {
        $rules = ["numsolicitud"    => "required|exists:plan__de__accion__individuals,numero_Solicitud"];
        $messages = ['exists' => 'La solicitud no existe.'];
        $requestsolicitud = ['numsolicitud' => $numsolicitud];
        $numsolicitudrequest = new Request($requestsolicitud);
        $this->validate($numsolicitudrequest, $rules, $messages);
        return $this->solicitudPAI()->resumePAI($numsolicitud, $request);
    }

    /**
     * Get question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $numsolicitud
     * @return \Illuminate\Http\Response
     */
    public function question()
    {
        $preguntas = Preguntas_Valoracion::all();
            $banco = $preguntas->map(function ($preguntas) {
                return $preguntas->only(['id', 'pregunta', 'categoria_Id']);
            });
        return ['Preguntas' => $banco];
    }
}
