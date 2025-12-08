<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambia esto si necesitas lógica de autorización
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'professional_id' => 'required|exists:professionals,id',
            'day_of_week' => [
                'required',
                'integer',
                'between:0,6', // Opcional, para validar días de la semana
                function ($attribute, $value, $fail) {
                    $exists = \App\Models\ProfessionalSchedule::where('professional_id', $this->professional_id)
                        ->where('day_of_week', $value)
                        ->exists();

                    if ($exists) {
                        $fail(__('Ya existe un registro con este día y profesional.'));
                    }
                },
            ],
            'time' => 'required|array',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'professional_id' => 'profesional',
            'day_of_week' => 'día de la semana',
        ];
    }
}
