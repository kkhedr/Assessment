<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        return $this->isMethod('post') ? $this->store() : $this->update();
    }

    private function store(){
        return [
            "title" => "required|string|max:255",
            "content" => "required|string|max:30000",
            "slug" => "required|string|unique:blogs,slug",
            "image" => "required|image|max:20000",
        ];
    }

    private function update(){
        $id = $this->route('blog');
        return [
            "title" => "nullable|string|max:255",
            "content" => "nullable|string|max:30000",
            "slug" => "nullable|string|unique:blogs,slug,{$id},id",
            "image" => "nullable|image|max:20000",
        ];
    }
}
