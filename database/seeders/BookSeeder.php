<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create(); // Create an instance of Faker
        
        // Insert 20 dummy records into the 'books' table
        $books = [];
        for ($i = 0; $i < 110; $i++) {
            $eventId = rand(1, 10);  // Define the $eventId for each book record

            $books[] = [
                'nama' => $faker->name,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'nomor_hp' => $faker->phoneNumber,
                'status_bayar' => 'paid',
                'id_event' => $eventId,  // Use the defined $eventId
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Increment the sold_tickets in the events table for each inserted book
            DB::table('events')
                ->where('id', $eventId)
                ->increment('sold_tickets');  // Correct column name: 'sold_tickets'
        }

        // Insert the books into the 'books' table
        DB::table('books')->insert($books);
    }
}
