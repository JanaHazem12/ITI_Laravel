<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class EditPostRequest extends FormRequest
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
        // dd($this->route('id')); // prints ID correctly
        return [
            'title' => ['required', 'min:3',Rule::unique('posts', 'title')->ignore($this->route('id'))],
            'description' => ['required','min:10'],
            'file' => ['image','mimes:jpg,png']
            // Rule::unique('posts', 'title')->ignore($this->post->id)
            // when I update and the title is NOT changed --> NOT UNIQUE (cause it compares the NOT CHANGED title w/ itself)
            // I don't want to compare the title w/ itself
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
            // 'file.required' => 'File is Required.',
            'file.image' => 'Uploaded file must be an image.',
            'file.mimes' => 'Image must be a file of type: jpg, png.'
        ];
    }
}
