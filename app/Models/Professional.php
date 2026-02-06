<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Observers\ProfessionalObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ProfessionalObserver::class])]
class Professional extends Model
{
    use SoftDeletes;

    use HasFactory;

    // use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'rut',
        'bio',
        'phone',
        'consultation_fee',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'consultation_fee' => 'decimal:2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * Get the user that owns the professional.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the portfolios for the professional.
     */
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Get the schedules for the professional.
     *
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(ProfessionalSchedule::class);
    }

    /**
     * Get the patients for the professional.
     *
     * @return HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * Get the bank accounts for the professional.
     *
     * @return HasMany
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(ProfessionalBankAccount::class);
    }

    /**
     * The medical specialties that belong to the professional.
     */
    public function medicalSpecialties(): BelongsToMany
    {
        return $this->belongsToMany(MedicalSpecialty::class);
    }

    /**
     * Get the professional's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->user->name} {$this->user->last_name}";
    }

    /**
     * Get the professional's url profile.
     *
     * @return string
     */
    public function getUrlProfileAttribute()
    {
        return route('professional', ['professional' => $this->slug]);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope para obtener los horarios de un profesional en un rango de fechas.
     *
     * @param Builder $query
     * @param int $professionalId
     * @param string|Carbon $startDate (Formato 'Y-m-d')
     * @param string|Carbon $endDate (Formato 'Y-m-d')
     * @return Builder
     */
    public function scopeSchedulesInRange(Builder $query, string|Carbon $startDate, string|Carbon $endDate): Builder
    {
        $start = $startDate instanceof Carbon ? $startDate : Carbon::parse($startDate);

        $end = $startDate instanceof Carbon ? $startDate : Carbon::parse($endDate);

        $daysOfWeek = [];

        while ($start->lte($end)) {

            $daysOfWeek[$start->toDateString()] = $start->dayOfWeek;

            $start->addDay();
        }

        return $query->with(['schedules' => function (Builder $query) use ($daysOfWeek) {
            $query->whereIn('day_of_week', array_values($daysOfWeek));
        }]);
    }
}
