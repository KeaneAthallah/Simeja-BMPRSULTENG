<?php

namespace Database\Seeders;

use App\Models\Complain;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'admin',
            'last_name' => '',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        Complain::create([
            'nik' => '123456781',
            'name' => 'Ucok Handoko',
            'phone' => '08123456789',
            'email' => 'Lm7j7@example.com',
            'lat' => '-0.8955705206557044',
            'long' => '119.857693823503',
            'address' => 'Jl. Imam Bonjol, No. 123',
            'aspirasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => 'Pending'
        ]);
        Complain::create([
            'nik' => '123456782',
            'name' => 'Asep Sandi',
            'phone' => '08123456789',
            'email' => 'Lm7j7@example.com',
            'lat' => '-0.9004837239838827',
            'long' => '119.85073080899366',
            'address' => 'Jl. Kangkung, No. 123',
            'aspirasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => 'On Progress'
        ]);
        Complain::create([
            'nik' => '123456783',
            'name' => 'Jono Kurniawan',
            'phone' => '08123456789',
            'email' => 'Lm7j7@example.com',
            'lat' => '-0.8881773583581348',
            'long' => '119.84236245317493',
            'address' => 'Jl. Lasoso, No. 123',
            'aspirasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => 'Completed'
        ]);
    }
}
