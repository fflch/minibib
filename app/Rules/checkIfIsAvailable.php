<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Emprestimo;

class checkIfIsAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Está emprestado?
        $emprestado = Emprestimo::where('instance_id',$value)->where('data_devolucao',null)->get();
        if(!$emprestado->isEmpty()){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não foi possível completar a operação, este exemplar encontra-se emprestado.';
    }
}
