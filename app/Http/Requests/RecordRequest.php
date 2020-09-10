<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Record;

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
        $record = new Record;
        return [
            'autores'     => 'required',
            'titulo'      => 'required',
            'desc_f'      => '',
            'editora'     => '',
            'assunto'     => '',
            'local_p'     => '',
            'localizacao' => '',
            'edicao'      => '',
            'ano'         => 'required|integer',
            'idioma'      => 'required',
            'isbn'        => '',
            'issn'        => '',
            'tipo'        => ['required', Rule::in($record->tipoOptions())],
        ];
    }
}
