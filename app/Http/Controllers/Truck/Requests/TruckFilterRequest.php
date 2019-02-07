<?php

namespace App\Http\Controllers\Truck\Requests;

use Urameshibr\Requests\FormRequest;

class TruckFilterRequest extends FormRequest
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
                'trucks_code' => 'integer|exists:truckers,trucks_code',
                'is_own' => 'in:Y,N',
                'cnh' => 'in:A,B,C,D,E',
                'is_loaded' => 'in:Y,N',
                'date' => 'in:daily,weekly,monthly',
            ];


        return $return;
    }
}