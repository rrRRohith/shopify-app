<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DuplicatePageRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'pages' => 'required|array',
            'pages.*.title' => 'required',
            'pages.*.status' => 'required|in:publish,draft',
            'pages.*.handle' => 'sometimes|nullable',
            'pages.*.replacer' => 'sometimes|nullable|array|'
        ];
    }
}
