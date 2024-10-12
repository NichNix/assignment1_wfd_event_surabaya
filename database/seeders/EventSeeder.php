<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('events')->insert([
            [
                'title' => 'Tech Expo 2024',
                'venue' => 'Surabaya Convention Center',
                'date' => '2024-03-15',
                'start_time' => '09:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'tags' => 'technology, expo',
                'organizer_id' => 1, 
                'event_category_id' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Music Concert 2024',
                'venue' => 'Gelora Bung Tomo',
                'date' => '2024-06-20',
                'start_time' => '19:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'tags' => 'music, concert',
                'organizer_id' => 2,
                'event_category_id' => 2, 
                'active' => 1,
            ],
            [
                'title' => 'Business Conference 2024',
                'venue' => 'Novotel Surabaya',
                'date' => '2024-09-10',
                'start_time' => '08:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'tags' => 'business, conference',
                'organizer_id' => 3,
                'event_category_id' => 3, 
                'active' => 1,
            ],
            
        ]);
    }
}
