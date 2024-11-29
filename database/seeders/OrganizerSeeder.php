<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizerSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizers')->insert([
            ['name' => 'Innovatech Solutions', 'description' => 'Leading technology solutions provider, responsible for organizing the Tech Expo 2024 in Surabaya.'],
            ['name' => 'Harmony Events Group', 'description' => 'Event management company specializing in large-scale concerts, including the Music Concert 2024.'],
            ['name' => 'Global Business Forums', 'description' => 'Experts in corporate events, behind the Business Conference 2024 aimed at fostering global business connections.'],
            ['name' => 'Epicurean Ventures', 'description' => 'Dedicated to curating unforgettable food experiences, organizers of the Food Festival.'],
            ['name' => 'Vanguard Fashion Group', 'description' => 'Premier fashion event organizers, presenting the latest trends at Fashion Week 2024.'],
            ['name' => 'Champion Sports Corp', 'description' => 'Pioneers in sports event management, responsible for organizing the Sports Championship and various athletic events.'],
            ['name' => 'Artistic Visions LLC', 'description' => 'A creative events agency, curating art exhibitions such as the Art Expo to celebrate contemporary artists.'],
            ['name' => 'Startup Hive Inc.', 'description' => 'Fostering innovation, Startup Hive organizes events like the Startup Summit to support entrepreneurs and startups.'],
            ['name' => 'Pen and Paper Productions', 'description' => 'A literary event management company organizing festivals, bringing authors and readers together for discussions and workshops.'],
            ['name' => 'Zenith Wellness Group', 'description' => 'Leading provider of wellness and mindfulness retreats, specializing in organizing rejuvenating wellness events.'],
        ]);
        
    }
}
