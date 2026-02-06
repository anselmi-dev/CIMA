<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\MedicalSpecialty;
use App\Models\Patient;
use App\Models\Professional;
use App\Notifications\AppointmentCreated;
use App\Models\ProfessionalSchedule;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
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

    #[Computed]
    public function professionals()
    {
        $start = $this->startDate instanceof Carbon ? $this->startDate : Carbon::parse($this->startDate);
        $daysOfWeek = [$start->toDateString() => $start->dayOfWeek];

        return Professional::whereHas('medicalSpecialties', function ($query) {
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
                    ->whereRaw(config('database.default') == 'pgsql' ? "jsonb_array_length(time::jsonb) > 0" : "JSON_LENGTH(time) > 0");
            })
            ->get();
    }

    /**
     * Claves de slots ocupados (professional_id|Y-m-d H).
     * Solo se incluyen citas con reserva activa (pending/confirmed).
     * Las canceladas no bloquean el slot.
     */
    #[Computed]
    public function appointments()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);

        return Appointment::query()
            ->where('start_at', '>=', $date->copy()->startOfMonth())
            ->where('start_at', '<=', $date->copy()->endOfMonth())
            ->whereIn('status', ['pending', 'confirmed'])
            ->get(['start_at', 'professional_id'])
            ->map(function ($appointment) {
                return trim($appointment->professional_id . '|' . $appointment->start_at->format('Y-m-d H'));
            });
    }

    public function render ()
    {
        return view('livewire.schedule.show', [
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

    /**
     * Busca el próximo día con al menos un horario libre y mueve el calendario a ese mes/año.
     * A partir de la fecha seleccionada; si es hoy, solo se consideran slots con al menos 3 horas de antelación.
     *
     * @return void
     */
    public function nextScheduleAvailable()
    {
        $start = ($this->startDate instanceof Carbon ? $this->startDate : Carbon::parse($this->startDate))->copy()->startOfDay();
        $end = $start->copy()->addDays(90);

        $appointmentsInRange = Appointment::query()
            ->where('start_at', '>=', $start)
            ->where('start_at', '<=', $end)
            ->where('status', '!=', 'cancelled')
            ->get(['start_at', 'professional_id'])
            ->map(fn ($a) => trim($a->professional_id . '|' . $a->start_at->format('Y-m-d H')));
        $appointmentKeysSet = $appointmentsInRange->flip()->all();

        $schedules = ProfessionalSchedule::query()
            ->where('is_presence', $this->type == 'presencial')
            ->whereHas('professional.medicalSpecialties', fn ($q) => $q->where('medical_specialty_id', $this->medicalSpecialty->id))
            ->whereNotNull('time')
            ->whereRaw(config('database.default') === 'pgsql' ? 'jsonb_array_length(time::jsonb) > 0' : 'JSON_LENGTH(time) > 0')
            ->get(['id', 'professional_id', 'day_of_week', 'time']);

        $minHoursFromNow = now()->addHours(3);

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $dayOfWeek = $date->dayOfWeek;
            $daySchedules = $schedules->filter(fn ($s) => (int) $s->day_of_week === $dayOfWeek);

            foreach ($daySchedules as $schedule) {
                $times = $schedule->time;
                if (! is_array($times)) {
                    continue;
                }
                foreach ($times as $timeStr) {
                    $slotDt = strlen((string) $timeStr) <= 2
                        ? Carbon::parse($date->toDateString())->setHour((int) $timeStr)->minute(0)->second(0)
                        : Carbon::parse($date->toDateString() . ' ' . $timeStr);
                    if ($date->isToday() && $slotDt->lt($minHoursFromNow)) {
                        continue;
                    }
                    $key = $schedule->professional_id . '|' . $slotDt->format('Y-m-d H');
                    if (! isset($appointmentKeysSet[$key])) {
                        $this->startDate = $date->copy();
                        $this->initializeCalendar();
                        return;
                    }
                }
            }
        }

        $this->startDate = $start->copy();

        $this->initializeCalendar();
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

        $patient = $this->current->professional->patients()->create([
            'rut' => strtoupper(trim($this->reservation['dni'])),
            'name' => $this->reservation['name'],
            'lastname' => $this->reservation['last_name'],
            'birthday' => Carbon::create($this->reservation['birthdate_year'], $this->reservation['birthdate_month'], $this->reservation['birthdate_day']),
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

        return $this->redirectRoute('schedule.confirm', [
            'appointment' => $appointment->uuid
        ], navigate: true);
    }
}
