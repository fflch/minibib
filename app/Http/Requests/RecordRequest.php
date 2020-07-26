<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'autores'     => 'required',
            'titulo'      => 'required',
            'desc_f'      => 'required',
            'editora'     => 'required',
            'assunto'     => 'required',
            'local_p'     => 'required',
            'localizacao' => 'required',
            'edicao'      => 'required',
            'ano'         => 'required|integer',
            'idioma'      => 'required',
            'isbn'        => 'required|integer',
            'issn'        => 'required|integer',
            'tipo'        => 'required',
        ];
    }
}
