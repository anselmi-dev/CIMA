<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\MedicalSpecialty;
use App\Models\Patient;
use App\Models\Professional;
use App\Notifications\AppointmentCreated;
use App\Models\ProfessionalSchedule;
use Carbon\Carbon;
use Livewire\Component;

class Schedule extends Component
{
    public MedicalSpecialty $medicalSpecialty;

    public $startDate;

    public $currentMonth;

    public $currentYear;

    public $daysInMonth;

    public $startOfMonth;

    public $endOfMonth;

    public $isOpen = false;

    public $current;

    public string $type;

    public $dates = [];

    /**
     * @var array
     */
    public $reservation = [
        'name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'dni' => '',
        'birthdate_year' => '',
        'birthdate_month' => '',
        'birthdate_day' => '',
    ];

    /**
     * @var array
     */
    public $rules = [
        'reservation.name' => 'required',
        'reservation.last_name' => 'required',
        'reservation.email' => 'required|email',
        'reservation.phone' => 'required',
        'reservation.dni' => 'required',
        'reservation.birthdate_year' => 'required',
        'reservation.birthdate_month' => 'required',
        'reservation.birthdate_day' => 'required',
    ];

    /**
     * @var array
     */
    public $messages = [
        'reservation.name.required' => 'El nombre es obligatorio',
        'reservation.last_name.required' => 'El apellido es obligatorio',
        'reservation.email.required' => 'El correo electrónico es obligatorio',
        'reservation.email.email' => 'El correo electrónico es inválido',
        'reservation.phone.required' => 'El teléfono es obligatorio',
        'reservation.dni.required' => 'El documento es obligatorio',
        'reservation.birthdate_year.required' => 'El año de nacimiento es obligatorio',
        'reservation.birthdate_month.required' => 'El mes de nacimiento es obligatorio',
        'reservation.birthdate_day.required' => 'El día de nacimiento es obligatorio',
    ];

    public function mount (
        ?MedicalSpecialty $medicalSpecialty
    )
    {
        $this->medicalSpecialty = $medicalSpecialty;

        $this->type = request()->tipo ?? 'presencial';

        $this->startDate = Carbon::now();

        $this->initializeCalendar();
    }

    public function render ()
    {
        $daysOfWeek = [];

        $start = $this->startDate instanceof Carbon ? $this->startDate : Carbon::parse($this->startDate);

        // $end = $this->endDate instanceof Carbon ? $this->endDate : Carbon::parse($this->endDate);

        $daysOfWeek[$start->toDateString()] = $start->dayOfWeek;

        // while ($start->lte($end)) {

        //     $daysOfWeek[$start->toDateString()] = $start->dayOfWeek;

        //     $start->addDay();
        // }

        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);

        $this->startOfMonth = $date->copy()->startOfMonth();

        $this->endOfMonth = $date->copy()->endOfMonth();

        $appointments = Appointment::query()
                                ->where('start_at', '>=', $date->copy()->startOfMonth())
                                ->where('start_at', '<=', $date->copy()->endOfMonth())
                                ->where('status', '!=', 'cancelled')
                                ->get(['start_at', 'professional_id'])
                                ->map(function ($appointment) {
                                    return trim($appointment->professional_id . '|' . $appointment->start_at->format('Y-m-d H'));
                                });

        $professionals = Professional::whereHas('medicalSpecialties', function ($query) {
            $query->where('medical_specialty_id', $this->medicalSpecialty->id);
        })
        ->with(['schedules' => function ($query) use ($daysOfWeek) {
            $query->whereIn('day_of_week', array_values($daysOfWeek))
                ->where('is_presence', $this->type == 'presencial');
        }])
        ->whereHas('schedules', function ($query) use ($daysOfWeek) {
            $query
                ->where('day_of_week', array_values($daysOfWeek))
                ->whereNotNull('time')
                ->where('is_presence', $this->type == 'presencial')
                ->whereRaw("jsonb_array_length(time::jsonb) > 0");
        })
        ->get();

        return view('livewire.schedule.show', [
            'medicalSpecialty' => $this->medicalSpecialty,
            'professionals' =>  $professionals,
            'appointments' => $appointments
        ])
        ->layout('layouts.simple');
    }

    public function initializeCalendar()
    {
        $this->currentMonth = $this->startDate->month;

        $this->currentYear = $this->startDate->year;

        $this->generateCalendar();
    }

    public function generateCalendar()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);

        $this->daysInMonth = $date->daysInMonth;

        $this->startOfMonth = $date->copy()->startOfMonth()->dayOfWeek;

        $this->endOfMonth = $date->copy()->endOfMonth();

        $this->dates = [];

        // Calcular los días previos del mes anterior para llenar la semana
        $prevMonthDays = $this->startOfMonth;
        $previousMonth = $date->copy()->subMonth();

        for ($i = $prevMonthDays; $i > 0; $i--) {
            $this->dates[] = [
                'date' => $previousMonth->copy()->endOfMonth()->subDays($i - 1),
                'currentMonth' => false
            ];
        }

        // Días del mes actual
        for ($i = 1; $i <= $this->daysInMonth; $i++) {
            $this->dates[] = [
                'date' => Carbon::create($this->currentYear, $this->currentMonth, $i),
                'currentMonth' => true,
            ];
        }

        // Días del próximo mes para completar la semana
        $remainingDays = 42 - count($this->dates);
        $nextMonth = $date->copy()->addMonth();

        for ($i = 1; $i <= $remainingDays; $i++) {
            $this->dates[] = [
                'date' => Carbon::create($nextMonth->year, $nextMonth->month, $i),
                'currentMonth' => false,
            ];
        }
    }

    public function nextMonth()
    {
        $this->startDate = $this->startDate->addMonth();

        $this->initializeCalendar();
    }

    public function prevMonth()
    {
        $this->startDate = $this->startDate->subMonth();

        $this->initializeCalendar();
    }

    public function selectDate ($date)
    {
        $this->startDate = Carbon::parse($date);
    }

    public function selectTime (ProfessionalSchedule $professionalSchedule, $time)
    {
        $this->current = (object) [
            'professionalSchedule' => $professionalSchedule,
            'professional' => $professionalSchedule->professional,
            'date' => Carbon::parse($time)
        ];

        $this->isOpen = true;
    }

    public function submit ()
    {
        $this->validate();

        $patient = Patient::updateOrCreate([
            'professional_id' => $this->current->professional->id,
            'rut' => strtoupper(trim($this->reservation['dni'])),
        ], [
            'name' => $this->reservation['name'],
            'lastname' => $this->reservation['last_name'],
            'birthday' => $this->reservation['birthdate_year'] . '-' . $this->reservation['birthdate_month'] . '-' . $this->reservation['birthdate_day'],
            'email' => $this->reservation['email'],
            'phone' => $this->reservation['phone'],
        ]);

        $appointment = Appointment::create([
            'professional_id' => $this->current->professional->id,
            'medical_specialty_id' => $this->medicalSpecialty->id,
            'patient_id' => $patient->id,
            'start_at' => $this->current->date,
            'data' => [
                ...$patient->toArray(),
                ...[
                    'medical_specialty' => $this->medicalSpecialty->name
                ]
            ]
        ]);

        return redirect()->route('schedule.success', [
            'appointment' => $appointment->uuid
        ]);
    }
}
