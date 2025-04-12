<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'unique:posts','min:3'],
            'description' => ['required','min:10'],
            'postCreator' => ['exists:users,id'],
            'file' => ['image','mimes:jpg,png']
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Title is Required.',
            'title.min' => 'Title should be at least 3 characters.',
            'title.unique' => 'Title should be unique.',
            'description.required' => 'Description is Required.',
            'description.min' => 'Description should be at least 10 characters.',
            'postCreator.exists' => 'user_id does not exist in the database.',
            // 'file.required' => 'File is Required.',
            'file.image' => 'Uploaded file must be an image.',
            'file.mimes' => 'Image must be a file of type: jpg, png.',
        ];
    }
}
