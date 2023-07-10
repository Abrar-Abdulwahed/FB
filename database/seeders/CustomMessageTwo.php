<?php

namespace Database\Seeders;

use App\Models\CustomMessage;
use App\Models\Seeder as ModelsSeeder;
use Illuminate\Database\Seeder;

class CustomMessageTwo extends Seeder
{
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $messages = [
                [
                    'code' => 'ticket.create',
                    'subject'=> 'إنشاء تذكرة جديدة',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    مرحبا يا userName!,
                     هذه رسالة مخصصة  عند إنشاء التذكرة
                    ',
                ],
                [
                    'code' => 'ticket.reply',
                    'subject'=> 'إضافة رد',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                     مرحبا يا userName!,
                     هذه رسالة مخصصة للرد على التذكرة
                    ',
                ],
            ];

            foreach ($messages as $message) {
                CustomMessage::create([
                    'code' => $message['code'],
                    'subject' => $message['subject'],
                    'type' => $message['type'],
                    'language' => $message['language'],
                    'text' => $message['text'],
                ]);
            }

            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
