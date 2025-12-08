<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Transaction extends Model implements HasMedia
{
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = [
        'transactionable_id',
        'transactionable_type',
        'amount',
        'payment_date',
        'method',
        'notify',
        'notes',
        'attribute_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'date',
        'attribute_data' => AsArrayObject::class,
        'notify' => 'date',
    ];

    /**
     * Get the parent transactionable model (user or order).
     */
    public function transactionable()
    {
        return $this->morphTo();
    }
}