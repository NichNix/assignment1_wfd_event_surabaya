<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('event_categories')->insert([
            ['name' => 'Expo', 'active' => 1],
            ['name' => 'Concert', 'active' => 1],
            ['name' => 'Conference', 'active' => 1],
            ['name' => 'Workshop', 'active' => 1],
            ['name' => 'Seminar', 'active' => 1],
            ['name' => 'Meetup', 'active' => 1],
            ['name' => 'Festival', 'active' => 1],
            ['name' => 'Webinar', 'active' => 1],
            ['name' => 'Sports Event', 'active' => 1],
            ['name' => 'Theater', 'active' => 1],
            ['name' => 'Charity Event', 'active' => 1],
            ['name' => 'Trade Show', 'active' => 1],
            ['name' => 'Fashion Show', 'active' => 1],
            ['name' => 'Art Exhibition', 'active' => 1],
            ['name' => 'Food & Drink', 'active' => 1],
            ['name' => 'Book Fair', 'active' => 1],
            ['name' => 'Music Festival', 'active' => 1],
            ['name' => 'Tech Conference', 'active' => 1],
            ['name' => 'Hackathon', 'active' => 1],
            ['name' => 'Networking Event', 'active' => 1],
        ]);
    }
}
