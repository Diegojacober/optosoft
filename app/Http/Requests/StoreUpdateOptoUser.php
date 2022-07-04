<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOptoUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        $id = $this->id ?? '';
        $rules =  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$id},id"],
            'password' => ['required', 'string', 'min:8'],
            'oticas' => ['array'],
        ];

        if($this->method() == 'PUT') {
            $rules['password'] = 'nullable|min:8|max:30';
        }

        return $rules;
    }
}
