<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            AdminSeeder::class,
            OrganizerSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,

        ]);
    }
}
