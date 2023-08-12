<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'avatar' => [
                'image',
                'mimes:jpeg,jpg,png',
                'max:2000',
                'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200',
            ],
            'todohuken' => 'required|string|in:' . implode(",",$prefectures),
            'publishing' => 'required|string|in:private,public',
            'email' => 'required|email',    
            'password' => 'required|min:4',
        ];
    }
}
