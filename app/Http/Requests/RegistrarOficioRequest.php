<?php

namespace Siged\Http\Requests;

use Siged\Http\Requests\Request;

class RegistrarOficioRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'fecha'     => 'required|date_format:d/m/Y',
            'numero'    => 'required',
            'remitente' => 'required',
            'asunto'    => 'required',
            'oficio'    => 'required|mimes:pdf'
        ];
    }
}
