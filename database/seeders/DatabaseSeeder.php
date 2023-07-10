<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CustomMessageSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            PaymentSeeder::class,
            ContentSeeder::class,
            FaqSeeder::class,
            FaqCategorySeeder::class,
            // additional
            SettingSeederTwo::class,
            CustomMessageTwo::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
