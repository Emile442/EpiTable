<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'day' => ['required', 'regex:/(today|tomorrow)/'],
            'slots' => 'required|exists:slots,id',
            'place' => ['required', 'regex:/^[0-9]+_[0-9]+$/'],
        ];
    }
}
