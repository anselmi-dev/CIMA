<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Política de privacidad',
                'slug' => 'privacy-policy',
                'content' => '<h2>Política de privacidad</h2><p>Este es el contenido de la política de privacidad. Puedes editarlo desde el panel de administración.</p><p>En esta página se describe cómo recopilamos, usamos y protegemos tu información personal.</p>',
                'active' => true,
                'custom' => true,
            ],
            [
                'name' => 'Términos y condiciones',
                'slug' => 'terms-and-conditions',
                'content' => '<h2>Términos y condiciones</h2><p>Este es el contenido de los términos y condiciones. Puedes editarlo desde el panel de administración.</p><p>Al utilizar nuestros servicios, aceptas los siguientes términos y condiciones de uso.</p>',
                'active' => true,
                'custom' => true,
            ],
            [
                'name' => 'Política de cookies',
                'slug' => 'cookie-policy',
                'content' => '<h2>Política de cookies</h2><p>Este es el contenido de la política de cookies. Puedes editarlo desde el panel de administración.</p><p>Utilizamos cookies para mejorar tu experiencia en nuestro sitio web.</p>',
                'active' => true,
                'custom' => true,
            ],
            [
                'name' => 'Testimonios',
                'slug' => 'testimonials',
                'content' => '<h2>Testimonios</h2><p>Este es el contenido de los testimonios. Puedes editarlo desde el panel de administración.</p><p>Utilizamos cookies para mejorar tu experiencia en nuestro sitio web.</p>',
                'active' => true,
                'custom' => true,
            ],
            [
                'name' => 'Preguntas frecuentes',
                'slug' => 'faqs',
                'content' => '<h2>Preguntas frecuentes</h2><p>Este es el contenido de las preguntas frecuentes. Puedes editarlo desde el panel de administración.</p><p>Utilizamos cookies para mejorar tu experiencia en nuestro sitio web.</p>',
                'active' => true,
                'custom' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['name' => $page['name']],
                [
                    'content' => $page['content'],
                    'active' => $page['active'],
                    'slug' => $page['slug'],
                    'custom' => $page['custom'],
                ]
            );
        }
    }
}
