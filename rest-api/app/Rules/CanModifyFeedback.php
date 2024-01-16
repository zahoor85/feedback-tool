<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class CanModifyFeedback implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $feedback = Feedback::find($value);
        if ($feedback && Auth::user()->id !== $value) {
            $fail('You are not allowed to update this feedback.');
        }

    }
}
