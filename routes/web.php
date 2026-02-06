<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\{
    Home,
    About,
    Contact,
    FAQs,
    Support,
    TermsAndConditions,
    PrivacyPolicy,
    CookiesPolicy,
    Testimonials,
    Professional,
    Professionals,
    Schedule,
    ScheduleSuccess,
    ScheduleConfirm,
    ScheduleCanceled,
    Schedule\SpecialitySchedule
};

Route::get('/', Home::class)->name('home');

Route::get('contacto', Contact::class)->name('contact');

Route::get('nosotros', About::class)->name('about');

Route::get('faqs', FAQs::class)->name('faqs');

Route::get('soporte', Support::class)->name('support');

Route::get('terminos-y-condiciones', TermsAndConditions::class)->name('terms-and-conditions');

Route::get('política-de-privacidad', PrivacyPolicy::class)->name('privacy-policy');

Route::get('política-de-cookies', CookiesPolicy::class)->name('cokies-policy');

Route::get('agendar/', SpecialitySchedule::class)->name('schedule.index');
Route::get('agendar/{medicalSpecialty:slug}', Schedule::class)->name('schedule');
Route::get('agendar/cita/{appointment:uuid}', ScheduleSuccess::class)->name('schedule.success');
Route::get('agendar/cita/{appointment:uuid}/confirmacion', ScheduleConfirm::class)->name('schedule.confirm');
Route::get('agendar/cita/{appointment:uuid}/cancelada', ScheduleCanceled::class)->name('schedule.canceled');

Route::get('profesionales', Professionals::class)->name('professionals');

Route::get('testimonios', Testimonials::class)->name('testimonials');

Route::get('profesional/{professional:slug}', Professional::class)->name('professional');

Route::get('test', function () {
    $appointment = \App\Models\Appointment::first();

    $appointment->status = 'confirmed';

    // $appointment->update([
    //     'status' => 'confirmed'

    // ]);
    $appointment->save();


    return (new \App\Mail\AppointmentToPatientCreated($appointment))->render();

    return \Mail::to('carlosanselmi2@gmail.com')->send(new \App\Mail\AppointmentToPatientCreated($appointment));
});

Route::get('test-cancel', function () {
    $appointment = \App\Models\Appointment::first();

    return (new \App\Mail\AppointmentToPatientCancel($appointment))->render();

    return \Mail::to('carlosanselmi2@gmail.com')->send(new \App\Mail\AppointmentToPatientCancel($appointment));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
