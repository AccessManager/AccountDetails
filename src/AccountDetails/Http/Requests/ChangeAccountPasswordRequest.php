<?php

namespace AccessManager\AccountDetails\AccountDetails\Http\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class ChangeAccountPasswordRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'  =>  ['required', 'confirmed'],
        ];
    }
}