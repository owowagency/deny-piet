<?php

namespace OwowAgency\DenyPiet\Rules;

use Illuminate\Contracts\Validation\Rule;

class PietNotAllowed implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! in_array($value, config('deny-piet.emails'));
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('deny-piet::general.not_allowed');
    }
}
