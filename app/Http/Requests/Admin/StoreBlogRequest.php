<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $prefectures = config('prefectures');
        return [
            'nickname' => 'required|string',
            'gender' =>'required|string|in:male,female,other',
            'todohuken' => 'required|string|in:' . implode(",",$prefectures),
            'publishing' => 'required|string|in:private,public',
            'password' => 'required|min:4',
            
            'avatar' => [
                'image',
                'mimes:jpeg,jpg,png',
                'max:2000',
                'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200',
            ], 
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
        ];
    }
}
