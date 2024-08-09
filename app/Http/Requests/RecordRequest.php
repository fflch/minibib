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
        $rules = [
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
        return $rules;
    }

    public function messages(){
        return[
            'autores.required' => 'O campo "autor" é obrigatório. Caso não haja, coloque "N/A"',
            'titulo.required' => 'O título é obrigatório',
            'ano.integer' => 'Insira um ano válido',
            'ano.required' => 'O ano é obrigatório',
            'idioma.required' => 'Insira um idioma válido',
            'tipo.required' => 'Insira o tipo' 
        ];
    }
}
