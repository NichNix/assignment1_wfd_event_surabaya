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
                'end_time' => '17:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'max_tickets' => 1000,
                'sold_tickets' => 0,
                'status' => 'available',
                'image' => 'assets/event/images.jpeg',
                'price' => 100000,
                'province_id' => 35,
                'regency_id' => 3578,
                'organizer_id' => 1, 
                'event_category_id' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Music Concert 2024',
                'venue' => 'Gelora Bung Tomo',
                'date' => '2024-06-20',
                'start_time' => '19:00:00',
                'end_time' => '21:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'max_tickets' => 500,
                'sold_tickets' => 0,
                'status' => 'available',
                'image' => 'assets/event/music-fest-2024.png',
                'price' => 50000,
                'province_id' => 73,
                'regency_id' => 7371,
                'organizer_id' => 2,
                'event_category_id' => 2, 
                'active' => 1,
            ],
            [
                'title' => 'Business Conference 2024',
                'venue' => 'Novotel Surabaya',
                'date' => '2024-09-10',
                'start_time' => '08:00:00',
                'end_time' => '18:00:00',
                'description' => $faker->text(200),
                'booking_url' => null,
                'active' => 1,
                'max_tickets' => 1200,
                'sold_tickets'=> 0,
                'status' => 'available',
                'image' => 'assets/event/business.png',
                'price' => 0,
                'province_id' => 91,
                'regency_id' => 9107,
                'organizer_id' => 3,
                'event_category_id' => 3, 
            ],          
        ]);
    }
}
