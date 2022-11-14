<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\addArchivosFromRequest_request;
use App\Http\Requests\addBecaFromRequest_request;
use App\Http\Requests\addFamiliarGroupRequest;
use App\Http\Requests\addJobFromRequest;
use App\Http\Requests\addManySickness;
use App\Http\Requests\NewInstitucionDeProcedenciaRequest;
use App\Http\Requests\NewNecesidadYApoyoRequest;
use App\Http\Requests\NewSeguimientoRequest;
use App\Http\Requests\observationRequest;
use App\Http\Requests\recomendacionRequest;
use App\Http\Requests\saludActualRequest;
use App\Http\Requests\solicitudAdecuacionRequest;
use App\Http\Requests\updateStatus_Request;
use App\Models\Institucion_Procedencia;
use App\Models\Revision_Solicitud;
use App\Models\SolicitudDeAdecuacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudesAdecuacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solicitudAdecuacion()
    {
        return $solicitud = new SolicitudDeAdecuacion();
    }
    public function revisionSolicitud()
    {
        return $revisionSolicitud = new Revision_Solicitud();
    }

    public function index()
    {
        return $this->solicitudAdecuacion()->getAll('');
    }

    /**
     * Crea una solicitud de adecuación paso 1, estudiante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createSolicitudDeAdecuacion(
     Request $request,
     solicitudAdecuacionRequest $solicitudAdecuacion,
     NewInstitucionDeProcedenciaRequest $institucionProcedencia,
     NewNecesidadYApoyoRequest $necesidadesY_Apoyo,
     addFamiliarGroupRequest $familiares,
     addArchivosFromRequest_request $archivos,
     saludActualRequest $salud)
    {
        $cedula = $request->cedula == null ? null : $request->cedula;
        return $this->solicitudAdecuacion()->add1($cedula, $solicitudAdecuacion->validated(),
                                                            $institucionProcedencia->validated(),
                                                            $necesidadesY_Apoyo->validated(),
                                                            $familiares->validated(), 
                                                            $archivos->validated(),
                                                            $salud->validated(),
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->solicitudAdecuacion()->get($id);
    }

    /**
     * Display the specified resource for student.
     *
     * @param  string $cedula. Only admin
     * @return \Illuminate\Http\Response
     */
    public function showForCarnet($carnet)
    {
        return $this->solicitudAdecuacion()->getForCarnet($carnet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->solicitudAdecuacion()->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($numSolicitud)
    {
        return $this->solicitudAdecuacion()->eliminarsolicitud($numSolicitud);
    }


     /**
     * Despliega la lista de observación de una Revisión de solicitud en especifico.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll_Observation($numSolicitud)
    {
        return $this->revisionSolicitud()->getAll_Observation($numSolicitud);
    }

    /**
     * Despliega la lista de observación de una Revisión de solicitud en especifico.
     *
     * @return \Illuminate\Http\Response
     */
    public function getObservation($numSolicitud, $id)
    {
        return $this->revisionSolicitud()->get_Observation($numSolicitud, $id);
    }

    /**
     * Agrega una observación a una solicitud.
     *
     * @param  string  $numSolicitud
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addObservation($numSolicitud, observationRequest $observationRequest )
    {
        return $this->revisionSolicitud()->addObservation($numSolicitud, $observationRequest->validated());
    }

    /**
     * Remueve una observación de una solicitud.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_Observation($numSolicitud, $id)
    {
        return $this->revisionSolicitud()->delete_Observation($numSolicitud, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_Observation($numSolicitud , $id, observationRequest $request)
    {
        return $this->revisionSolicitud()->update_Observation($numSolicitud, $id, $request->validated());
    }

    //Recommendation
 /**
     * Despliega la lista de recomendacion de una Revisión de solicitud en especifico.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll_Recommendation($numSolicitud)
    {
        return $this->revisionSolicitud()->getAll_recommendation($numSolicitud);
    }

    /**
     * Despliega la lista de recomendacion de una Revisión de solicitud en especifico.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecommendation($numSolicitud, $id)
    {
        return $this->revisionSolicitud()->get_recommendation($numSolicitud, $id);
    }

    /**
     * Agrega una recomendacion a una solicitud.
     *
     * @param  string  $numSolicitud
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRecommendation($numSolicitud, recomendacionRequest $recommendationRequest )
    {
        return $this->revisionSolicitud()->addrecommendation($numSolicitud, $recommendationRequest->validated());
    }

    /**
     * Remueve una recomendacion de una solicitud.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_Recommendation($numSolicitud, $id)
    {
        return $this->revisionSolicitud()->delete_recommendation($numSolicitud, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_Recommendation($numSolicitud , $id, recomendacionRequest $request)
    {
        return $this->revisionSolicitud()->update_recommendation($numSolicitud, $id, $request->validated());
    }
    //End Recommendation

    /**
     * Update status. Only Admin
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateState($numSolicitud, updateStatus_Request $status)
    {
        return $this->revisionSolicitud()->updateStatus($numSolicitud, $status);
    }

    
}
