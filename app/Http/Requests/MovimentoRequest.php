<?php

namespace App\Http\Requests;

use App\Rules\DestinoRule;
use App\Rules\SaldoRule;
use Illuminate\Foundation\Http\FormRequest;

class MovimentoRequest extends FormRequest
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
            "valor" => ["required",new SaldoRule],
            "carteira_destino" => [
                "required",
                "exists:carteira,id",
                new DestinoRule
            ],
        ];
    }

}
