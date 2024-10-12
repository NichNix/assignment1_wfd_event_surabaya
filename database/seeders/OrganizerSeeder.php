<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizerSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizers')->insert([
            ['name' => 'Organizer 1', 'description' => 'Description for Organizer 1'],
            ['name' => 'Organizer 2', 'description' => 'Description for Organizer 2'],
            ['name' => 'Organizer 3', 'description' => 'Description for Organizer 3'],
            ['name' => 'Organizer 4', 'description' => 'Description for Organizer 4'],
            ['name' => 'Organizer 5', 'description' => 'Description for Organizer 5'],
        ]);
    }
}
