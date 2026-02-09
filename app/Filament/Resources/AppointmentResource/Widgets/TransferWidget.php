<?php

namespace App\Filament\Resources\AppointmentResource\Widgets;

use App\Models\Appointment;
use Filament\Widgets\Widget;

class TransferWidget extends Widget
{
    protected static string $view = 'filament.widgets.transfer-widget';

    protected int | string | array $columnSpan = 'full';

    public ?Appointment $record = null;

    public function getTransaction()
    {
        if (!$this->record) {
            return null;
        }

        return $this->record->transactions()
            ->where('method', 'transfer')
            ->latest()
            ->first();
    }
}
