<?php

namespace App\Http\Requests;

use App\Rules\preventPost;
use Illuminate\Foundation\Http\FormRequest;

class UpdatepostRequest extends FormRequest
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
            'title' => ['required', 'min:3',new preventPost()],
            'description' => ['required', 'string', 'min:3', 'max:255'],
//            'creator' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ];
    }
}
