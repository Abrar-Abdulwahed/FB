<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seeder as SeederModel;


class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $seeder = SeederModel::where('class_name', __CLASS__)->count();
        if ($seeder == 0) {

            $faq1 = Faq::query()->create([
                'title' => 'تجربة سؤال 1',
                'answer' => 'الاجابة على تجربة سؤال 1',
            ]);

            $faq2 = Faq::query()->create([
                'title' => 'تجربة سؤال 2',
                'answer' => 'الاجابة على تجربة سؤال 2',
            ]);

            $faq1 = Faq::query()->create([
                'title' =>'تجربة سؤال 3',
                'answer' => 'الاجابة على تجربة سؤال 3',
            ]);

            SeederModel::create(array('class_name' => __CLASS__));
        }

    }
}
