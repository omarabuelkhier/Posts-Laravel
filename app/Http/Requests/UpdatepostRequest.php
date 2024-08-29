<?php

namespace App\Http\Requests;

use App\Rules\preventPost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatepostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()) {
            return true;
        }
        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3',Rule::unique('posts')->ignore($this->post),new preventPost()],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ];
    }
}
