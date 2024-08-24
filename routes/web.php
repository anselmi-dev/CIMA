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
};

Route::get('/', Home::class)->name('home');

Route::get('contacto', Contact::class)->name('contact');

Route::get('nosotros', About::class)->name('about');

Route::get('faqs', FAQs::class)->name('faqs');

Route::get('soporte', Support::class)->name('support');

Route::get('terminos-y-condiciones', TermsAndConditions::class)->name('terms-and-conditions');

Route::get('política-de-privacidad', PrivacyPolicy::class)->name('privacy-policy');

Route::get('política-de-cookies', CookiesPolicy::class)->name('cokies-policy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
