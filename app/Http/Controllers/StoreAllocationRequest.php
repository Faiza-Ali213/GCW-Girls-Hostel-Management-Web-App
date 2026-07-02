<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'allocation_date' => 'required|date|before_or_equal:today',
            'remarks' => 'nullable|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Please select a student.',
            'student_id.exists' => 'Selected student does not exist.',
            'room_id.required' => 'Please select a room.',
            'room_id.exists' => 'Selected room does not exist.',
            'allocation_date.required' => 'Allocation date is required.',
            'allocation_date.before_or_equal' => 'Allocation date cannot be in the future.',
        ];
    }
}