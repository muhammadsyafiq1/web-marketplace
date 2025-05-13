<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'avatar' => 'image.jpg',
            'name' => 'admin',
            'roles' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'store_status' => 0
        ]);

        User::create([
            'avatar' => 'image.jpg',
            'name' => 'customer',
            'roles' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'store_status' => 0
        ]);

        User::create([
            'avatar' => 'image.jpg',
            'name' => 'store',
            'roles' => 'store',
            'email' => 'store@gmail.com',
            'password' => Hash::make('12345678'),
            'store_status' => 1
        ]);

        Category::create([
            'name' => 'Kecantikan',
            'slug' => 'Kecantikan',
            'photo' => 'image.jpg'
        ]);
    }
}
