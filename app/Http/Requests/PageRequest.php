<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\Page;

class PageRequest extends FormRequest{
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
    public function __construct(ValidationFactory $validationFactory){     
        $validationFactory->extend(
            'handle',
            function($attribute, $value, $parameters){
                $page = request()->page->id ?? 0;
                return !$value || !Page::whereHandle($value)->whereShopId(shop()->id)->where('id', '!=', $page)->first();
            },
            'Handle is already taken for this shop.'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        
        return [
            'title' => 'required',
            'status' => 'required|in:publish,draft',
            'handle' => 'sometimes|nullable|handle',
        ];
    }
}
