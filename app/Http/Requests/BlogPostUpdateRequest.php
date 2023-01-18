<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200|min:3',
            'slug' => 'max:200',
            'excerpt' => 'max:500',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'content_raw' => 'required|string|max:10000|min:5',
        ];
    }
}
