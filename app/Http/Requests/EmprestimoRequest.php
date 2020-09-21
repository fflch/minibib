<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Emprestimo;

class EmprestimoRequest extends FormRequest
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
        $instances = new Emprestimo;
        return [
            'instance_id'     => '',
            'data_emprestimo' => 'required',
            'data_devolucao'  => 'required',
            'n_usp'           => 'required',
            'user_id'         => '', 
        ];
    }
}
