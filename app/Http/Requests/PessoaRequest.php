<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
        $user_id = !empty(auth()->user()) ? auth()->user()->id : null;
        $required = empty($user_id) ? "required": "nullable";
        return [
            "cpf_cnpj" => "$required|cpfcnpj|unique:pessoa,cpf_cnpj,$user_id",
            "nome" => "$required",
            "email" => "$required|email|unique:pessoa,email,$user_id",
            "senha" => "$required"
        ];
    }

    public function messages()
    {
       return [
           "cpf_cnpj.unique" => "The cpf cnpj has already been taken."
       ];
    }
}
