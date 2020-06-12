<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestPostControllerRequest extends FormRequest
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
            'firstname' => 'string|required|min:1',
            'lastname' => 'string|required|min:1',
            'age' => 'integer|required'
        ];
    }
}
