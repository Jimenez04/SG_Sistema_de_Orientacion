<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_studentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'carnet' => 'required|min:4|max:20',
            'ano_Ingreso' => 'date_format:Y-m-d',
            'profesor_Consejero' => 'string',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'carnet.required' => 'El carnet es requerido',
            'carnet.min' => 'El carnet no es valido, debe tener al menos 4 caracteres',
            'carnet.max' => 'El carnet no es valido, debe tener maximo 20 caracteres',

            'ano_Ingreso.date_format' => 'La fecha de ingreso no tiene un formato valido',
            
            'profesor_Consejero.string' => 'El profesor consejero debe ser una cadena de caracteres',

        ];
    }
}
