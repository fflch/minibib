<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Instance;

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
        $rules = [
            'record_id'   => 'required|integer',
            'tombo'       => ['required'],
            'localizacao' => ['required'],
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['tombo'], 'unique:instances,tombo,' .$this->instance->id);
            array_push($rules['localizacao'], 'unique:instances,localizacao,' .$this->instance->id);
        }
        else{
            array_push($rules['tombo'], 'unique:instances');
            array_push($rules['localizacao'], 'unique:instances');
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'tombo' => preg_replace('/[^0-9]/', '', $this->tombo),
        ]);
    }
}
