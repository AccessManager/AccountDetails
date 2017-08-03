<?php

namespace AccessManager\AccountDetails\Http\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class AddSubscriptionRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}