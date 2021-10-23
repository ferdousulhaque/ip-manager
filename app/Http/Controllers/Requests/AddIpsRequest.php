<?php

namespace App\Http\Controllers\Requests;

class AddIpsRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'ip' => 'required|ipv4',
            'desc' => 'required|string',
        ];
    }
}
