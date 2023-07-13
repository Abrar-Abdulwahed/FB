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
                'app.name' => 'Freelancer',
                'site_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias corporis, quo minus nulla cum hic repudiandae dolorem perferendis velit ex! Ut eveniet nostrum repellat fugit quod sequi quasi asperiores beatae!',
                'site_logo' => null,
                'site_status' => 'active',
                'reason_locked' => null,
                'google_enable' => 'on',
                'services.google.client_id' => '305295164959-957dbe2g9bm59oslqmjnjl96ek0sfiid.apps.googleusercontent.com',
                'services.google.client_secret' => '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',
                'facebook_enable' => 'on',
                'services.facebook.client_id' => '216796600748740',
                'services.facebook.client_secret' => '465dd3a53f01c039cf544bec281f8085',
                'captcha_enable' => 'off',
                'recaptcha.api_site_key' => '6LfU1LImAAAAAAnmzNitKGDofM5vpnn26Ny2-_Rn',
                'recaptcha.api_secret_key' => '6LfU1LImAAAAAJuimHgma-JGiwSn_3auQFiTdmNf',
                'mail.default' => 'smtp', //mail_mailer
                'mail.mailers.smtp.host' => 'sandbox.smtp.mailtrap.io',
                'mail.mailers.smtp.port' => '2525',
                'mail.mailers.smtp.username' => 'afc6ec5280b09e',
                'mail.mailers.smtp.password' => 'e75b3575c9e84c',
                'mail.from.address' => 'no-reply@mailtrap.club',
                'mail.from.name' => 'Freelancer',
                'header_script' => null,
                'footer_script' => null,
                'faq_enable' => 'on',
                'article_enable' => 'on',
                'page_enable' => 'on',
                'short_link_enable' => 'on',
                'register_enable' => 'on',
                'email_confirm_enable' => 'off',
                'comment_enable' => 'on',
                'telegram_report_enable' => 'on',
                'slack_report_enable' => 'on',
                'logging.channels.telegram.chat_id' => '-872387523',
                'logging.channels.telegram.token' => '6329661294:AAEGcU9NzgKSHikRqUnzncaiZVGyhmzUUHM',
                'logging.channels.slack.url' => 'https://hooks.slack.com/services/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',
                'email_report_enable' => 'on',
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
