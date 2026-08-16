<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class postRequestValidator extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>['required','min:3','max:30'],
            'description' => ['required','min:5','max:200'],
            'price' => ['required','numeric'],
            'image' => ['nullable','mimes:png,jpg,jpeg,gif'] // 'max:2048' means the max img size is 2048 KB (2 MB)
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'image.mimes' => 'Only Accepts png,jpg,jpeg,gif',
           
        ];
    }
}
