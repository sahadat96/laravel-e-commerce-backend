<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'sumon',
            'phone' => '01612385878',
            'email' => 'sumon@gmail.com',
            'password' => Hash::make('sumon5678@dhaka'),
            'role' => 'admin', // if you have role management
        ]);
    }
}
