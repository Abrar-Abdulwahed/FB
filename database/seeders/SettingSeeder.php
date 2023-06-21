<?php

namespace Database\Seeders;

use App\Models\Seeder as ModelsSeeder;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $settings = [
                'site_name' => 'Freelance',
                'site_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias corporis, quo minus nulla cum hic repudiandae dolorem perferendis velit ex! Ut eveniet nostrum repellat fugit quod sequi quasi asperiores beatae!',
                'site_logo' => '',
                'google_client_id' => '305295164959-957dbe2g9bm59oslqmjnjl96ek0sfiid.apps.googleusercontent.com',
                'google_client_secret' => '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',
                'google_client_redirect' => 'http://localhost:8000/auth/google/callback',
                'fb_client_id' => '216796600748740',
                'fb_client_secret' => '465dd3a53f01c039cf544bec281f8085',
                'fb_client_redirect' => 'http://localhost:8000/auth/facebook/callback',
                'recaptcha_site_key' => '6LfU1LImAAAAAAnmzNitKGDofM5vpnn26Ny2-_Rn',
                'recaptcha_secret_key' => '6LfU1LImAAAAAJuimHgma-JGiwSn_3auQFiTdmNf',
                'mail_mailer' => 'smtp',
                'mail_host' => 'sandbox.smtp.mailtrap.io',
                'mail_port' => '2525',
                'mail_username' => '15a79cc7bff6a4',
                'mail_password' => '6cba1ce2351cc4',
                'mail_from_address' => 'hello@example.com',
                'mail_from_name' => 'laravel',
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
