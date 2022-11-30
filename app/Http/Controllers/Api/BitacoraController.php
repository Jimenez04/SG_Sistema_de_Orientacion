<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\itemBitacoraRequest;
use App\Models\Item_Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{

    public function bitacora()
    {
        return $bitacora = new Item_Bitacora();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) //Only admin
    {
        $rules = ["id"    => "required|exists:bitacoras,id"];
        $messages = ['exists' => 'La bitácora no existe.'];
        $requestB = ['id' => $id];
        $bitacora = new Request($requestB);
        $this->validate($bitacora, $rules, $messages);
       return  $this->bitacora()->get_all($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, itemBitacoraRequest $request)
    {
        $rules = ["id"    => "required|exists:bitacoras,id"];
        $messages = ['exists' => 'La bitácora no existe.'];
        $requestB = ['id' => $id];
        $bitacora = new Request($requestB);
        $this->validate($bitacora, $rules, $messages);
        return $this->bitacora()->add($id, $request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $itemid)
    {
        $rules = ["id"    => "required|exists:bitacoras,id", 'itemid' => "required|exists:item__bitacoras,id"];
        $messages = ['exists' => 'La bitácora no existe.' , 'required' => 'El id es requerido'];
        $requestB = ['id' => $id, 'itemid' => $itemid];
        $bitacora = new Request($requestB);
        $this->validate($bitacora, $rules, $messages);
         return $this->bitacora()->get($id, $itemid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $itemid, itemBitacoraRequest $request)
    {
        $rules = ["id"    => "required|exists:bitacoras,id"];
        $messages = ['exists' => 'La bitácora no existe.'];
        $requestB = ['id' => $id];
        $bitacora = new Request($requestB);
        $this->validate($bitacora, $rules, $messages);
        return $this->bitacora()->update_e($id, $itemid, $request->validated());
    }

}
