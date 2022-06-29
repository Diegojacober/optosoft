<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOptometrist extends FormRequest
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
        $uuid = $this->optometrist;
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:optometristas,name,{$uuid},uuid"],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'phone' => 'required|string|min:11|max:11'
        ];

        if($this->method() == 'PUT'){
            $rules['photo'] = "nullable|image|max:1024";
        }
    }
}
