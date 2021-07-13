<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
        $A = array("0", "1", "2", "3");
        return [
            'eventName' => 'required|min:20',
            'bandNames' => 'required',
            'startDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:startDate',
            'ticketPrice' => 'gt:0',
            'status' => 'gt:0|lt:3',

        ];
    }

    public function messages()
    {
        return [
            'eventName.min' => 'Tên sự kiện phải lớn hơn 20 ký tự.',
            'ticketPrice.min' => 'Phải lớn hơn 0',
            'startDate.after' => 'Phải sau ngày hiện tại.',
            'endDate.after' => 'Phải sau ngày start.',
            'status.gt' => 'Phải có giá trị 0, 1, 2, 3.',
            'status.lt' => 'Phải có giá trị 0, 1, 2, 3.'
        ];
    }

    // validate theo business riêng.
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->get('name') == 'xuanhung'){
                $validator->errors()->add('name', 'Tao không chơi với thằng Hùng.');
            }
        });
    }
}
