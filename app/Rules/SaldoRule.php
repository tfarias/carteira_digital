<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaldoRule implements Rule
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
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function passes($attribute, $value)
    {
        $carteira = auth()->user()->carteira();
        return floatval($carteira->saldo) >= floatval($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value is greater than the balance';
    }
}
