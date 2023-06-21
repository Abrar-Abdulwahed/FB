<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Seeder as SeederModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $seeder = SeederModel::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {

            $user = User::query()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@admin.com'),
            ]);

            $user->roles()->sync([1]);

            SeederModel::create(array('class_name' => __CLASS__));
        }
    }
}
