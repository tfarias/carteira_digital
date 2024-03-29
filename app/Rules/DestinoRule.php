<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DestinoRule implements Rule
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
        return (int)$carteira->id !== (int)$value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Transfers are not allowed for you.';
    }
}
