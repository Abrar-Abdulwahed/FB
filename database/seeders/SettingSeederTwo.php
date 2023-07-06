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
                'site_logo' => 'logo.webp',
            ];
            foreach ($settings as $name => $value) {
                Setting::updateOrCreate(['name' => $name], ['value' => $value]);
            }
            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
