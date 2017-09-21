<?php

namespace AccessManager\AccountDetails\AccountSubscription\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class ChangeSubscriptionPasswordRequest extends BaseFormRequest
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