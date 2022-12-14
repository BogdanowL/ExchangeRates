<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencySample extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function data()
    {
        $array = $this->get('rates')[0];
        $charCodes = $this->clearCharCodes($array);

        return new CurrencySampleData($charCodes);
    }

    public function clearCharCodes($codes)
    {
        $string = implode(',', $codes);
        $string = str_replace('"', '', $string);
        $string = str_replace(' ', '', $string);
        return explode(',', $string);
    }
}
