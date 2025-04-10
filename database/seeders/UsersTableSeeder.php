<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin CMS',
            'email' => 'admincms@gmail.com',
            'password' => bcrypt('@1234#'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Sub Admin CMS',
            'email' => 'subadmincms@gmail.com',
            'password' => bcrypt('@1234'),
            'role' => 'sub-admin',
        ]);
    }
}