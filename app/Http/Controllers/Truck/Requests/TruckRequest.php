<?php

namespace App\Http\Controllers\Truck\Requests;

use Urameshibr\Requests\FormRequest;

class TruckRequest extends FormRequest
{

    protected function validationData()
    {
        return $this->request->all();
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
            $return = [
                'name' => 'required|max:100',
                'age' => 'required|integer',
                'sex' => 'required|in:F,M',
                'trucks_code' => 'required|integer|exists:trucks,code',
                'is_own' => 'required|in:Y,N',
                'cnh' => 'required|in:A,B,C,D,E',
                'is_loaded' => 'required|in:Y,N',
                'number' => 'required|integer',
                'street' => 'required|max:100',
                'neighborhood' => 'required|max:100',
                'city' => 'required|max:100',
                'state' => 'required|max:2',
                'country' => 'required|max:100',
            ];


        return $return;
    }
}