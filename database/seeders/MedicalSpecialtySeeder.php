<?php

namespace Database\Seeders;

use App\Models\MedicalSpecialty;
use Illuminate\Database\Seeder;

class MedicalSpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Psicopedagogía',
                'description' => "Entendemos que cada persona aprende a su propio ritmo.",
                'content' => "En nuestra área de psicopedagogía, acompañamos los procesos de aprendizaje en todas las etapas de la vida, desde la niñez hasta la adultez mayor, identificando sus fortalezas y apoyándolos en sus desafíos. Consideramos que aprender es un proceso continuo, dinámico y profundamente humano, por lo que evaluamos, intervenimos y orientamos de manera personalizada, promoviendo el desarrollo de habilidades cognitivas, emocionales y sociales que favorecen un aprendizaje significativo y una vida cotidiana más segura y confiada.",
            ],
            [
                'name' => 'Psicología',
                'description' => "Te escuchamos, te acompañamos, te cuidamos.",
                'content' => "Nuestro equipo de psicólogos y psicólogas está comprometido con brindar un espacio seguro y empático para que puedas expresarte, comprender tus emociones y trabajar en tu bienestar. Atendemos a personas de todas las edades, adaptando nuestras terapias a cada etapa del ciclo vital.",
            ],
            [
                'name' => 'Fonoaudiología',
                'description' => "La comunicación es el puente que nos une.",
                'content' => "Desde el lenguaje oral y escrito hasta la voz y la audición, nuestros fonoaudiólogos y fonoaudiólogas trabajan para potenciar las habilidades comunicativas de niños, niñas, adolescentes y adultos. A través de evaluaciones y terapias individuales, fortalecemos uno de los aspectos más esenciales del desarrollo: la capacidad de comunicarse.",
            ],
            [
                'name' => 'Babysitters',
                'description' => "Cuidamos con cariño y responsabilidad.",
                'content' => "Contamos con babysitters capacitadas/os que acompañan el desarrollo de los más pequeños, entregando apoyo a las familias en el día a día. Promovemos una crianza respetuosa, con enfoque integral y mucha dedicación en cada momento compartido.",
            ],
        ];

        foreach ($specialties as $data) {
            MedicalSpecialty::updateOrCreate(
                ['name' => $data['name']],
                ['description' => $data['description'],
                'content' => $data['content'],]
            );
        }

        collect(['Cardiología', 'Dermatología'])->each(function ($name) {
            MedicalSpecialty::firstOrCreate(['name' => $name]);
        });
    }
}
