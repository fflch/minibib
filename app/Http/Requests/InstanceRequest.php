<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Instance;

class InstanceRequest extends FormRequest
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
        $instance = new Instance;
        return [
            'record_id' => 'required|integer',
            'tombo'     => 'required',
        ];
    }
}
