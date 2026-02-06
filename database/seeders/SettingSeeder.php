<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Rawilk\Settings\Facades\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keys = [
            'email' => 'info@cer.cl',
            'social' => [
                'facebook_url' => '',
                'instagram_url' => '',
                'twitter_url' => '',
                'linkedin_url' => '',
                'youtube_url' => '',
                'tiktok_url' => '',
            ],
            'seo' => [
                'meta_title' => 'CER | Clínica de Endocrinología y Nutrición',
                'meta_description' => 'CER es una clínica de endocrinología y nutrición que ofrece servicios de diagnóstico y tratamiento para una amplia gama de condiciones endocrinas y nutricionales.',
                'meta_keywords' => 'endocrinología, nutrición, diagnóstico, tratamiento, clínica',
                'og_image' => '',
            ],
        ];

        foreach ($keys as $key => $value) {
            Settings::set($key, $value);
        }
    }
}
