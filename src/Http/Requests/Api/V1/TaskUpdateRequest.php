<?php

namespace Farhadhp\SimpleTodo\Http\Requests\Api\V1;

use Farhadhp\SimpleTodo\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            'title' => 'string',
            'description' => 'string',
            'status' => [
                'numeric',
                'in:'.implode(',', array_keys(Task::ALL_STATUS))
            ]
        ];
    }
}
