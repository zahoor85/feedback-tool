<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CanModifyFeedback;

class UpdateFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["required", "max:255"],
            "description" => ["required", "max:400"],
            "user_id" => ["required", "exists:users,id",new CanModifyFeedback],
            "category_id" => ["required", "exists:categories,id"],
            'status' => 'required|in:open,closed',
            'is_comment' => "required|boolean"
        ];
    }
}
