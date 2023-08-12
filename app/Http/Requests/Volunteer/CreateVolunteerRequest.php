<?php

namespace App\Http\Requests\Volunteer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVolunteerRequest extends FormRequest
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
        return [
            'event_id' => 'required|integer|exists:events,id,deleted_at,NULL',
            'role' => ['required','in:worship_lead,keyboard,guitar,bass,drum,lcd,sound,camera,green_screen', Rule::unique('volunteers')->where(function ($query) {
                return $query->where('event_id', $this->event_id);
            })->where('deleted_at', null)],
            'user_id' => ['required','integer','exists:users,id,deleted_at,NULL',
                Rule::unique('volunteers', 'user_id')->where(function ($query) {
                    return $query->where('event_id', $this->event_id);
                })->where('deleted_at', null)
            ],
        ];
    }
}
