<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest{
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
            'title' => 'required',
            'url' => 'required',
            'custom_url' => 'sometimes|nullable',
            'api_version' => 'required',
            'api_key' => 'required',
            'api_password' => 'required',
        ];
    }

    public function getValidatorInstance(){
        $this->cleanURL();
        return parent::getValidatorInstance();
    }

    /**
     * Remove protocols from url and custom url.
     * 
     *@return void 
     */

    protected function cleanURL(){
        $this->merge([
            'url' => rtrim(preg_replace("(^https?://)", "", $this->url), '/'),
            'custom_url' => rtrim(preg_replace("(^https?://)", "", $this->custom_url), '/'),
        ]);
    }
}
