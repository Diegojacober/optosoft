<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateReceita extends FormRequest
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
        $rules = [
            'oticas' => ['required','array'],
            'nome' => ['required','string','min:3'],
            'idade' => ['required'],
            'od_esferico' => ['nullable'],
            'od_cilindrico' => ['nullable'],
            'od_eixo' => ['nullable'],
            'oe_esferico' => ['nullable'],
            'oe_cilindrico' => ['nullable'],
            'oe_eixo' => ['nullable'],
            'adicao' => ['nullable'],
            'obs' => ['nullable','min:3'],
            'ac' => ['nullable','string'],
            'acd' => ['nullable','string'],
            'ace' => ['nullable','string'],
        ];

        return $rules;
    }
}
