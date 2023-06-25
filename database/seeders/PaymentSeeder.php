<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\Seeder as SeederModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = SeederModel::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $methods = ['Paypal', 'Coinpayment'];
            foreach ($methods as $method) {
                PaymentMethod::query()->create([
                    'name' => $method
                ]);
            }

            SeederModel::create(array('class_name' => __CLASS__));
        }
    }
}
