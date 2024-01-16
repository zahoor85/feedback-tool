<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
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
            // "user_id" => ["required", "exists:users,id"],
            "category_id" => ["required", "exists:categories,id"],
            'status' => 'required|in:draft,published',
            'is_comment' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'category_id.required' => 'Select a Category',
            'status.required' => 'Choose a Status',
            'is_comment.required' => 'Allow Comment field is required'
        ];
    }
}
