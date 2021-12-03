<?php

namespace App\Http\Requests\Cabinet\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'content' => 'required|min:10',
            'image' => ['nullable'],
            'user_id' => ['integer'],
            'category_id' => ['exists:categories,id', 'integer'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['nullable','exists:tags,id', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Это поле обязательно для заполнения',
            'title.string' => 'Строковый формат',
            'content.required' => 'Это поле обязательно для заполнения',
            'content.min' => 'Не меньше 10 символов!',
        ];
    }
}
