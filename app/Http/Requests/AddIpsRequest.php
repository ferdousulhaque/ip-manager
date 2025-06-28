<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddIpsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ip' => 'required|ipv4|unique:ips,ip',
            'desc' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ip.required' => 'IP address is required.',
            'ip.ipv4' => 'Please provide a valid IPv4 address.',
            'ip.unique' => 'This IP address is already registered.',
            'desc.required' => 'Description is required.',
            'desc.max' => 'Description cannot exceed 255 characters.',
        ];
    }
} 