<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizerSeeder extends Seeder
{
    public function run()
    {
        DB::table('organizers')->insert([
            [
                'name' => 'Innovatech Solutions',
                'email' => 'contact@innovatech.com',
                'password' => bcrypt('Innovatech2024'),
                'description' => 'Leading technology solutions provider, responsible for organizing the Tech Expo 2024 in Surabaya.',
                'facebook_link' => 'https://facebook.com/innovatech',
                'x_link' => 'https://x.com/innovatech',
                'website_link' => 'https://innovatech.com',
            ],
            [
                'name' => 'Harmony Events Group',
                'email' => 'info@harmonyevents.com',
                'password' => bcrypt('Harmony2024'),
                'description' => 'Event management company specializing in large-scale concerts, including the Music Concert 2024.',
                'facebook_link' => 'https://facebook.com/harmonyevents',
                'x_link' => 'https://x.com/harmonyevents',
                'website_link' => 'https://harmonyevents.com',
            ],
            [
                'name' => 'Global Business Forums',
                'email' => 'admin@globalforums.com',
                'password' => bcrypt('Global2024'),
                'description' => 'Experts in corporate events, behind the Business Conference 2024 aimed at fostering global business connections.',
                'facebook_link' => 'https://facebook.com/globalforums',
                'x_link' => 'https://x.com/globalforums',
                'website_link' => 'https://globalforums.com',
            ],
            [
                'name' => 'Epicurean Ventures',
                'email' => 'support@epicurean.com',
                'password' => bcrypt('Epicurean2024'),
                'description' => 'Dedicated to curating unforgettable food experiences, organizers of the Food Festival.',
                'facebook_link' => 'https://facebook.com/epicureanventures',
                'x_link' => 'https://x.com/epicureanventures',
                'website_link' => 'https://epicurean.com',
            ],
            [
                'name' => 'Vanguard Fashion Group',
                'email' => 'hello@vanguardfashion.com',
                'password' => bcrypt('Vanguard2024'),
                'description' => 'Premier fashion event organizers, presenting the latest trends at Fashion Week 2024.',
                'facebook_link' => 'https://facebook.com/vanguardfashion',
                'x_link' => 'https://x.com/vanguardfashion',
                'website_link' => 'https://vanguardfashion.com',
            ],
            [
                'name' => 'Champion Sports Corp',
                'email' => 'events@championsports.com',
                'password' => bcrypt('Champion2024'),
                'description' => 'Pioneers in sports event management, responsible for organizing the Sports Championship and various athletic events.',
                'facebook_link' => 'https://facebook.com/championsports',
                'x_link' => 'https://x.com/championsports',
                'website_link' => 'https://championsports.com',
            ],
            [
                'name' => 'Artistic Visions LLC',
                'email' => 'contact@artisticvisions.com',
                'password' => bcrypt('Artistic2024'),
                'description' => 'A creative events agency, curating art exhibitions such as the Art Expo to celebrate contemporary artists.',
                'facebook_link' => 'https://facebook.com/artisticvisions',
                'x_link' => 'https://x.com/artisticvisions',
                'website_link' => 'https://artisticvisions.com',
            ],
            [
                'name' => 'Startup Hive Inc.',
                'email' => 'info@startuphive.com',
                'password' => bcrypt('Startup2024'),
                'description' => 'Fostering innovation, Startup Hive organizes events like the Startup Summit to support entrepreneurs and startups.',
                'facebook_link' => 'https://facebook.com/startuphive',
                'x_link' => 'https://x.com/startuphive',
                'website_link' => 'https://startuphive.com',
            ],
            [
                'name' => 'Pen and Paper Productions',
                'email' => 'admin@penandpaper.com',
                'password' => bcrypt('PenPaper2024'),
                'description' => 'A literary event management company organizing festivals, bringing authors and readers together for discussions and workshops.',
                'facebook_link' => 'https://facebook.com/penandpaperproductions',
                'x_link' => 'https://x.com/penandpaperproductions',
                'website_link' => 'https://penandpaper.com',
            ],
            [
                'name' => 'Zenith Wellness Group',
                'email' => 'info@zenithwellness.com',
                'password' => bcrypt('Zenith2024'),
                'description' => 'Leading provider of wellness and mindfulness retreats, specializing in organizing rejuvenating wellness events.',
                'facebook_link' => 'https://facebook.com/zenithwellness',
                'x_link' => 'https://x.com/zenithwellness',
                'website_link' => 'https://zenithwellness.com',
            ],
        ]);
    }
}

