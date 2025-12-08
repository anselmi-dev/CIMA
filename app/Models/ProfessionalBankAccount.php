<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalBankAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_id',
        'bank_details',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bank_details' => 'array',
    ];

    /**
     * Get the professional that owns the bank account.
     * 
     * @return BelongsTo
     */
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }
}