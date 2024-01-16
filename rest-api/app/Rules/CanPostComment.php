<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Feedback;

class CanPostComment implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $feedback = Feedback::find($value);
        
        if ($feedback && $feedback->is_comment === 0) {
            $fail('You are not allowed to post a comment on this feedback.');
        }
    }
}
