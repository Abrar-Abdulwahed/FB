<?php

namespace Database\Seeders;

use App\Models\Seeder as ModelsSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $roles = ['admin', 'user'];
            foreach ($roles as $role) {
                DB::table('roles')->insert([
                    'name' => $role,
                ]);
            }
            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
