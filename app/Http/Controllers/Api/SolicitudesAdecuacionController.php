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
use App\Http\Requests\solicitudAdecuacionRequest;
use App\Models\Institucion_Procedencia;
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
     addManySickness $enfermedades,
     addJobFromRequest $trabajos,
     addFamiliarGroupRequest $familiares,
     addBecaFromRequest_request $beca,
     addArchivosFromRequest_request $archivos)
    {
        $cedula = $request->cedula == null ? null : $request->cedula;
        return $this->solicitudAdecuacion()->add1($cedula, $solicitudAdecuacion->validated(),
                                                            $institucionProcedencia->validated(),
                                                            $necesidadesY_Apoyo->validated(),
                                                            $enfermedades->validated(),
                                                            $trabajos->validated(),
                                                            $familiares->validated(),
                                                            $beca->validated(),
                                                            $archivos->validated(),
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
    public function destroy($id)
    {
        return $this->solicitudAdecuacion()->delete($id);
    }


    /**
     * Update status. Only Admin
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id, $status)
    {
        return $this->solicitudAdecuacion()->updateStatus($id, $status);
    }

    
}
