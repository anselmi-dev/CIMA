<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\BankFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_id',
        'name',
        'lastname',
        'rut',
        'birthday',
        'email',
        'phone',
    ];

    /**
     * Get the appointments for the patient.
     * 
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the professional that owns the Patient.
     *
     * @return BelongsTo
     */
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => "{$this->name} {$this->lastname}",
        );
    }
}
