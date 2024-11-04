<?php

namespace Database\Seeders;

use App\Models\AsphaltStreet;
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
            'image' => 'complain_images/ZvfEZFgztRYEwEQyNpoupuDZow9PWqKJd5ReJD1O.jpg',
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
            'image' => 'complain_images/ZvfEZFgztRYEwEQyNpoupuDZow9PWqKJd5ReJD1O.jpg',
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
            'image' => 'complain_images/ZvfEZFgztRYEwEQyNpoupuDZow9PWqKJd5ReJD1O.jpg',
            'long' => '119.84236245317493',
            'address' => 'Jl. Lasoso, No. 123',
            'aspirasi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => 'Completed'
        ]);
        AsphaltStreet::create([
            'noProvinsi' => '72',
            'namaProvinsi' => 'SULAWESI TENGAH',
            'kabupaten' => 'SIGI',
            'dariPatok' => '0+000',
            'kePatok' => '0+100',
            'noRuas' => '01423',
            'namaRuas' => 'SP. KULAWI - GIMPU',
            'fungsi' => 'KP-2',
            'date' => '2023-08-18',
            'surveyor' => '1,2',
            'permukaanPerkerasan' => '2',
            'kondisi' => '4',
            'penurunan' => '4',
            'tambalan' => '1',
            'jenis' => '4',
            'lebar' => '3',
            'luas' => '4',
            'jumlahLubang' => '4',
            'ukuranLubang' => '4,5',
            'bekasRoda' => '1',
            'kerusakanTepiKiri' => '3',
            'kerusakanTepiKanan' => '3',
            'kondisiBahuKiri' => '3',
            'kondisiBahuKanan' => '3',
            'permukaanBahuKiri' => '3',
            'permukaanBahuKanan' => '3',
            'kondisiSaluranKiri' => '3',
            'kondisiSaluranKanan' => '3',
            'kerusakanLerengKiri' => '3',
            'kerusakanLerengKanan' => '3',
            'trotoarKiri' => '3',
            'trotoarKanan' => '3',
        ]);
    }
}
