<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitProjectRequest extends FormRequest
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

	        'comm_cdc_group_name'     => 'required_if:park_rec_fac,1|required_if:comm_cdc_group,1',
        ];
    }

	public function messages()
	{
		return [
			'comm_cdc_group_name.required_if' => "It looks like you're running a community group, CDC project, or park/recreation project. Please enter the name of the park, recreation center, or community group",
		];
	}
}
