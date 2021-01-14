<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Emprestimo;
use App\Models\Instance;
use App\Rules\checkIfIsAvailable;
use Illuminate\Validation\Rule;

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
        # Existe instance_id nas instâncias?
        $instance = Instance::where('id',$this->instance_id)->pluck('id')->toArray();

        return [
            'instance_id'     => ['required','integer', new checkIfIsAvailable(), Rule::in($instance)],
            'n_usp'           => 'required|integer|codpes', 
        ];
    }
}
