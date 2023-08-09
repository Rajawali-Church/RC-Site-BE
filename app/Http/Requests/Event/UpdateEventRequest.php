<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $this['id'] = $this->route('id');

        return [
            'id' => 'required|integer|exists:events,id,deleted_at,NULL',
            'name' => 'string',
            'date' => 'date_format:Y-m-d',
            'type' => 'in:weekly,special',
            'decription' => 'string',
            'created_by' => 'prohibited'
        ];
    }
}
