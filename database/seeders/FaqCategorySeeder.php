<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seeder as SeederModel;


class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $seeder = SeederModel::where('class_name', __CLASS__)->count();
        if ($seeder == 0) {

            $faq_category1 = FaqCategory::query()->create([
                'name' => 'faq category 1',
            ]);

            $faq_category2 = FaqCategory::query()->create([
                'name' => 'faq category 1',
            ]);

            SeederModel::create(array('class_name' => __CLASS__));
        }
    }
}
