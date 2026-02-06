<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'María González',
                'role' => 'Paciente',
                'content' => 'Excelente plataforma. Pude agendar mi cita con facilidad y el especialista me atendió puntualmente. Muy recomendable.',
                'rating' => 5,
                'active' => true,
                'sort' => 1,
            ],
            [
                'name' => 'Carlos Rodríguez',
                'role' => 'Paciente',
                'content' => 'Proceso sencillo y transparente. La opción de pago por transferencia me resultó muy cómoda. Repetiré sin duda.',
                'rating' => 5,
                'active' => true,
                'sort' => 2,
            ],
            [
                'name' => 'Ana Martínez',
                'role' => null,
                'content' => 'Encontré al profesional que necesitaba en pocos minutos. La búsqueda por especialidad es muy útil.',
                'rating' => 4,
                'active' => true,
                'sort' => 3,
            ],
            [
                'name' => 'Pedro Sánchez',
                'role' => 'Paciente',
                'content' => 'Buen trato y sistema claro. Pude cancelar una cita sin problemas cuando tuve un imprevisto.',
                'rating' => 4,
                'active' => true,
                'sort' => 4,
            ],
            [
                'name' => 'Laura Fernández',
                'role' => null,
                'content' => 'Recomiendo CIMA a cualquiera que busque agendar citas médicas de forma rápida y segura.',
                'rating' => 5,
                'active' => true,
                'sort' => 5,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                [
                    'name' => $data['name'],
                    'content' => $data['content'],
                ],
                [
                    'role' => $data['role'],
                    'rating' => $data['rating'],
                    'active' => $data['active'],
                    'sort' => $data['sort'],
                ]
            );
        }
    }
}
