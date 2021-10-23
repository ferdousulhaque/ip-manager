<?php

namespace App\Http\Controllers\Requests;

class ModifyIpRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'desc' => 'required|string',
        ];
    }
}
