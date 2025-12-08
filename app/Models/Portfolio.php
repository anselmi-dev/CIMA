<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'period',
        'institute',
        'professional_id'
    ];

    /**
     * Get the professional that owns the portfolio.
     */
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
