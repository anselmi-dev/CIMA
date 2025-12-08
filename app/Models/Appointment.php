<?php

namespace App\Models;

use App\Events\AppointmentCreated;
use App\Events\AppointmentUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use App\Casts\StatusCast;
use Illuminate\Database\Eloquent\Builder;

class Appointment extends Model
{
    /**
     * The event map for the model.
     *
     * @var array<string, class-string<\Illuminate\Contracts\Events\Event>>
     */
    protected $dispatchesEvents = [
        'created' => AppointmentCreated::class,
        'updated' => AppointmentUpdated::class,
    ];

    /** @use HasFactory<\Database\Factories\BankFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_id',
        'patient_id',
        'medical_specialty_id',
        'is_presence',
        'start_at',
        'end_at',
        'status',
        'data',
        'uuid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'data' => 'json',
        'is_presence' => 'boolean',
        // 'status' => StatusCast::class,
    ];

    /**
     * Get the patient that owns the appointment.
     *
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    
    /**
     * Get the professional that owns the appointment.
     *
     * @return BelongsTo
     */
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    /**
     * The medical specialty that belongs to the appointment.
     */
    public function medicalSpecialty(): BelongsTo
    {
        return $this->belongsTo(MedicalSpecialty::class);
    }

    /**
     * Scope a query to only include presence appointments.
     */
    public function scopePresence ($query): Builder
    {
        return $query->where('is_presence', true);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}