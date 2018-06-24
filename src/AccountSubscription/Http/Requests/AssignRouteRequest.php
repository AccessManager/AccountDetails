<?php

namespace AccessManager\AccountDetails\AccountSubscription\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class AssignRouteRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cidr'  =>  ['required',],
        ];
    }
}