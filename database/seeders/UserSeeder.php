<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Peter',
                'email' => 'peter@medisah.com',
                'merchant_id' => 1,
                'role' => 'Superadmin',
                'job_title' => 'Director',
                'password' => Hash::make('secret')
            ]
        );
        User::create(
            [
                'name' => 'Malvern',
                'email' => 'malvern@medisah.com',
                'merchant_id' => 1,
                'role' => 'Superadmin',
                'job_title' => 'Director',
                'password' => Hash::make('secret')
            ]
        );
        User::create(
            [
                'name' => 'Mairos',
                'email' => 'mairos@medisah.com',
                'merchant_id' => 1,
                'role' => 'Superadmin',
                'job_title' => 'Director',
                'password' => Hash::make('secret')
            ]
        );
    }
}
