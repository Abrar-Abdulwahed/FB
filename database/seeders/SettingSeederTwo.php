<?php

namespace Database\Seeders;

use App\Models\Seeder as ModelsSeeder;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeederTwo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $settings = [
                'telegram_report_enable'            => 'on',
                'slack_report_enable'               => 'on',
                'logging.channels.telegram.chat_id' => '-872387523',
                'logging.channels.telegram.token'   => '6329661294:AAEGcU9NzgKSHikRqUnzncaiZVGyhmzUUHM',
                'logging.channels.slack.url'        => 'https://hooks.slack.com/services/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 ',
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}