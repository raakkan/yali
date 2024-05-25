<?php

namespace Raakkan\Yali\Database\Seeders;

use Illuminate\Database\Seeder;
use Raakkan\Yali\Models\Language;

class YaliDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Call other seeders or perform seeding logic here
        // For example:
        // $this->call(AnotherSeeder::class);
        // Model::factory()->count(10)->create();

        Language::create([
            'name' => 'English',
            'code' => 'en',
            'rtl' => false,
            'is_active' => true,
            'is_default' => true,
        ]);

        Language::create([
            'name' => 'Arabic',
            'code' => 'ar',
            'rtl' => true,
            'is_active' => true,
            'is_default' => false,
        ]);

    }
}
