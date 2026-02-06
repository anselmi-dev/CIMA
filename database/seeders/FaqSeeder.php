<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'ask' => '¿Cómo me registro en CIMA?',
                'answer' => 'Para registrarte en CIMA, simplemente haz clic en "Registrarse" en la parte superior de la página. Sigue los pasos para crear tu cuenta, verifica tu identidad con autenticación de doble factor, y ya estarás listo para buscar y agendar citas con especialistas.',
            ],
            [
                'ask' => '¿Cómo puedo buscar un especialista?',
                'answer' => 'Puedes buscar un especialista utilizando nuestra barra de búsqueda en la página principal. Filtra los resultados por especialidad, ubicación, o disponibilidad para encontrar al profesional que mejor se adapte a tus necesidades.',
            ],
            [
                'ask' => '¿Cómo se realiza el pago de las citas?',
                'answer' => 'CIMA ofrece múltiples opciones de pago seguras, incluyendo tarjetas de crédito/débito y transferencias bancarias. Puedes seleccionar tu método de pago preferido al momento de reservar tu cita.',
            ],
            [
                'ask' => '¿Es seguro utilizar CIMA?',
                'answer' => 'Sí, en CIMA tomamos muy en serio la seguridad. Implementamos autenticación con doble factor para proteger tu cuenta, y todos los profesionales son verificados y aprobados antes de poder ofrecer sus servicios en la plataforma.',
            ],
            [
                'ask' => '¿Puedo cambiar o cancelar una cita?',
                'answer' => 'Sí, puedes cambiar o cancelar tu cita directamente desde tu cuenta en CIMA. Ten en cuenta que cada profesional puede tener políticas específicas de cancelación, que te serán informadas antes de confirmar tu cita.',
            ],
            [
                'ask' => '¿Qué hago si necesito ayuda?',
                'answer' => 'Si necesitas asistencia, puedes contactarnos directamente a través de nuestro soporte. Estamos disponibles por correo electrónico y WhatsApp para responder cualquier pregunta o resolver problemas que puedas tener.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::firstOrCreate(
                ['ask' => $faq['ask']],
                ['answer' => $faq['answer'], 'sort' => $index + 1]
            );
        }
    }
}
