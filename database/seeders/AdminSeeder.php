<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'name' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password1'),
                'created_at' => now(),
            ],
            [
                'name' => 'Admin 2',
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('password2'),
                'created_at' => now(),
            ]
            ]);
            
    }
}
