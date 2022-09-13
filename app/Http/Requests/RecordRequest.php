<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Record;

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
            'autores'      => 'required',
            'titulo'       => 'required',
            'desc_fisica'       => 'nullable',
            'editora'      => 'nullable',
            'assunto'      => 'nullable',
            'local_publicacao'      => 'nullable',
            'localizacao'  => 'nullable',
            'edicao'       => 'nullable',
            'isbn'         => 'nullable',
            'issn'         => 'nullable',
            'ano'          => 'required|integer',
            'idioma'       => ['required', Rule::in(array_keys($record->idiomasOptions()))],
            'tipo'         => ['required', Rule::in($record->tipoOptions())]
        ];
    }
}
