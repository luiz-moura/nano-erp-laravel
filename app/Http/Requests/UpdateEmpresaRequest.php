<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmpresaRequest extends FormRequest
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
            'nome'                  => 'required',
            'cpf_cnpj'              => [
                'nullable',
                Rule::unique('pessoas')->ignore($this->empresa->id)
            ],
            'inscricao_estadual'    => [
                'nullable',
                Rule::unique('pessoas')->ignore($this->empresa->inscricao_estadual)
            ],
        ];
    }
}
