<?php

namespace App\Observers;

use App\Models\Professional;
use Carbon\Carbon;

class ProfessionalObserver
{
    /**
     * Handle the Professional "created" event.
     */
    public function created(Professional $professional): void
    {
        collect([
            Carbon::SUNDAY,
            Carbon::MONDAY,
            Carbon::TUESDAY,
            Carbon::WEDNESDAY,
            Carbon::THURSDAY,
            Carbon::FRIDAY,
            Carbon::SATURDAY,
        ])->map(function ($day) use ($professional) {
            $professional->schedules()->create([
                'day_of_week' => $day,
                'is_presence' => true,
                'time' => []
            ]);

            $professional->schedules()->create([
                'day_of_week' => $day,
                'is_presence' => false,
                'time' => []
            ]);
        });
    }

    /**
     * Handle the Professional "updated" event.
     */
    public function updated(Professional $professional): void
    {
        //
    }

    /**
     * Handle the Professional "deleted" event.
     */
    public function deleted(Professional $professional): void
    {
        //
    }

    /**
     * Handle the Professional "restored" event.
     */
    public function restored(Professional $professional): void
    {
        //
    }

    /**
     * Handle the Professional "force deleted" event.
     */
    public function forceDeleted(Professional $professional): void
    {
        //
    }
}
