<?php

use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Page;

if (! function_exists('getTimeAutoCancelation')) {
    /**
     * Obtiene el tiempo de cancelación automática.
     */
    function getTimeAutoCancelation(): string
    {
        $settings = settings('time_auto_cancelation');

        if (!$settings) {
            return '3 horas';
        }

        return $settings->value;
    }
}

if (! function_exists('hasTestimonials')) {
    /**
     * Verifica si hay testimonios activos.
     */
    function hasTestimonials(): bool
    {
        return Testimonial::active()->exists();
    }
}

if (! function_exists('hasFAQs')) {
    /**
     * Verifica si hay preguntas frecuentes activas.
     */
    function hasFAQs(): bool
    {
        return Faq::exists() && Page::where('slug', 'faqs')->where('active', true)->exists();
    }
}

if (! function_exists('hasPrivacyPolicy')) {
    /**
     * Verifica si hay política de privacidad activos.
     */
    function hasPrivacyPolicy(): bool
    {
        return Page::where('slug', 'privacy-policy')->where('active', true)->exists();
    }
}

if (! function_exists('hasTermsAndConditions')) {
    /**
     * Verifica si hay términos y condiciones activos.
     */
    function hasTermsAndConditions(): bool
    {
        return Page::where('slug', 'terms-and-conditions')->where('active', true)->exists();
    }
}

if (! function_exists('hasCookiesPolicy')) {
    /**
     * Verifica si hay política de cookies activos.
     */
    function hasCookiesPolicy(): bool
    {
        return Page::where('slug', 'cookie-policy')->where('active', true)->exists();
    }
}
