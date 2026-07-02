<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'remarks' => 'nullable|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Please select a room.',
            'room_id.exists' => 'Selected room does not exist.',
        ];
    }
}