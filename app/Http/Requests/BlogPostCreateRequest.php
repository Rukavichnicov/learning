<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title' => 'required|max:200|min:3|unique:blog_posts',
            'slug' => 'max:200|unique:blog_posts',
            'excerpt' => 'max:500',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'content_raw' => 'required|string|max:10000|min:5',
        ];
    }

    /**
     * Получение сообщение об ошибке на опредлённые правила проверки
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Введите заголовок статьи',
            'content_raw.min' => 'Минимальная длина статьи [:min] символов',
        ];
    }

    /**
     * Получение названий атрибутов
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'content_raw' => 'Статья',
        ];
    }
}
