<?php

namespace App\Livewire;

use App\Models\AdminBankAccount;
use App\Models\Appointment;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class ScheduleConfirm extends Component
{
    use WithFileUploads;

    public Appointment $appointment;

    /** Tamaño máximo del comprobante en KB (10 MB). */
    public int $receiptMaxSizeKb = 10240;

    /** Tipos MIME permitidos para el comprobante. */
    public array $receiptAcceptedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];

    public $receipt;

    public string $note = '';

    public bool $terms_accepted = false;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;

        if ($this->appointment->status === 'confirmed') {
            return $this->redirect(route('schedule.success', ['appointment' => $this->appointment->uuid]), navigate: true);
        }
        if ($this->appointment->status === 'cancelled') {
            return $this->redirect(route('schedule.canceled', ['appointment' => $this->appointment->uuid]), navigate: true);
        }
    }

    protected function rules(): array
    {
        return [
            'receipt' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:' . $this->receiptMaxSizeKb],
            'note' => ['nullable', 'string', 'max:500'],
            'terms_accepted' => ['required', 'accepted'],
        ];
    }

    protected function messages(): array
    {
        $maxSizeMb = (int) ($this->receiptMaxSizeKb / 1024);
        return [
            'receipt.required' => __('El comprobante de pago es obligatorio.'),
            'receipt.file' => __('Debe subir un archivo válido.'),
            'receipt.mimes' => __('El comprobante debe ser PNG, JPG o PDF.'),
            'receipt.max' => __('El comprobante no puede superar :max MB.', ['max' => $maxSizeMb]),
            'note.max' => __('La nota no puede superar 500 caracteres.'),
            'terms_accepted.accepted' => __('Debes aceptar los términos y condiciones para continuar.'),
        ];
    }

    public function submit()
    {
        $this->validate();

        $transaction = $this->appointment->transactions()->create([
            'amount' => 0,
            'method' => 'transfer',
            'payment_date' => now(),
            'notes' => $this->note ?: null,
        ]);

        $transaction->addMedia($this->receipt->getRealPath())
            ->usingFileName($this->receipt->getClientOriginalName())
            ->toMediaCollection('default');

        $this->appointment->update(['status' => 'confirmed']);

        return $this->redirect(route('schedule.success', ['appointment' => $this->appointment->uuid]), navigate: true);
    }

    public function cancelReservation()
    {
        $this->appointment->update(['status' => 'cancelled']);

        return $this->redirect(route('schedule.canceled', ['appointment' => $this->appointment->uuid]), navigate: true);
    }

    public function render()
    {
        return view('livewire.schedule.confirm', [
            'bankAccounts' => AdminBankAccount::where('status', true)->get(),
        ]);
    }
}
