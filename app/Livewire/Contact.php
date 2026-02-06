<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $last_name = '';

    public string $email = '';

    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => __('El nombre es obligatorio.'),
            'name.max' => __('El nombre no puede superar 255 caracteres.'),
            'last_name.required' => __('El apellido es obligatorio.'),
            'last_name.max' => __('El apellido no puede superar 255 caracteres.'),
            'email.required' => __('El correo electrónico es obligatorio.'),
            'email.email' => __('El correo electrónico no es válido.'),
            'message.required' => __('El mensaje es obligatorio.'),
            'message.max' => __('El mensaje no puede superar 5000 caracteres.'),
        ];
    }

    public function submit()
    {
        $this->validate();

        $to = settings('email');
        if (empty($to)) {
            $this->addError('email', __('No está configurado un correo de contacto. Por favor, inténtelo más tarde.'));
            return;
        }

        try {
            Mail::to($to)->send(new ContactFormMail(
                name: $this->name,
                last_name: $this->last_name,
                email: $this->email,
                message: $this->message,
            ));

            $this->reset(['name', 'last_name', 'email', 'message']);
            session()->flash('contact.success', __('Tu mensaje se ha enviado correctamente. Te responderemos a la brevedad.'));
        } catch (\Throwable $e) {
            report($e);
            $this->addError('email', __('No se pudo enviar el mensaje. Por favor, inténtelo más tarde o contacte por otro medio.'));
        }
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
