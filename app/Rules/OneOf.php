<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OneOf implements ValidationRule
{

    public function __construct(
        readonly private FormRequest $request,
        readonly string $a,
        readonly string $b,
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->request[$this?->a] && $this->request[$this?->b]) {
            $fail('Either ' . $this?->a . ' or ' . $this->b .' must filled, not both');
        }
    }
}
