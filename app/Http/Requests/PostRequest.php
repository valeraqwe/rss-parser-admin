<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'link' => 'required|url',
            'published_at' => 'required|date'
        ];

        // Если это обновление, исключаем текущий пост из проверки уникальности ссылки
        if ($this->isMethod('patch')) {
            $rules['link'] = 'required|url|unique:posts,link,' . $this->route('post');
        }

        return $rules;
    }
}
