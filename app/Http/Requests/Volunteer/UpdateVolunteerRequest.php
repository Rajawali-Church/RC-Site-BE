<?php

namespace App\Http\Requests\Volunteer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVolunteerRequest extends FormRequest
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
            'id' => 'required|integer|exists:volunteers,id,deleted_at,NULL',
            'user_id' => ['exists:users,id,deleted_at,NULL', 
                Rule::unique('volunteers')->ignore($this->id)->where(function ($query) {
                    return $query->where('event_id', $this->event_id);
                })->where('deleted_at', null)],
            'event_id' => ['exists:events,id,deleted_at,NULL'],
            'role' => ['required','in:worship_lead,keyboard,guitar,bass,drum,lcd,sound,camera,green_screen', 
                Rule::unique('volunteers', 'role')->ignore($this->id)->where(function ($query) {
                    return $query->where('event_id', $this->event_id);
                })->where('deleted_at', null)
            ]
        ];
    }
}
