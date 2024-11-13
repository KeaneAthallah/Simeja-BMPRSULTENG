<?php

namespace Database\Seeders;

use App\Models\AsphaltStreet;
use App\Models\AsphaltStreetData;
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
            'name' => 'admin',
            'nip' => '11111111111',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'staff',
            'nip' => '11111111111',
            'email' => 'staff@test.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'staff2',
            'nip' => '11111111111',
            'email' => 'staff2@test.com',
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
        // AsphaltStreet::create([
        //     'noProvinsi' => 72,
        //     'namaProvinsi' => 'Sulawesi Tengah',
        //     'kabupaten' => 'Palu',
        //     'noRuas' => 0002,
        //     'namaRuas' => 'JLN. JUANDA (PALU)',
        //     'fungsi' => 'KP2',
        //     'date' => '2023-08-18',
        //     'surveyor' => '1,2'
        // ]);
        // AsphaltStreet::create([
        //     'noProvinsi' => 72,
        //     'namaProvinsi' => 'Sulawesi Tengah',
        //     'kabupaten' => 'Palu',
        //     'noRuas' => 01524,
        //     'namaRuas' => 'GIMPU - TUARE (BTS. KAB. POSO)',
        //     'fungsi' => 'KP2',
        //     'date' => '2023-08-18',
        //     'surveyor' => '2,3'
        // ]);
        // AsphaltStreetData::create([
        //     'asphalt_street_id' => 1,
        //     'dariPatok' => '0+000',
        //     'jenisPerkerasan' => 'Aspal',
        //     'kePatok' => '0+100',
        //     'permukaanPerkerasan' => 1,
        //     'kondisi' => 1,
        //     'penurunan' => 1,
        //     'tambalan' => 1,
        //     'jenis' => 1,
        //     'lebar' => 1,
        //     'luas' => 1,
        //     'jumlahLubang' => 1,
        //     'ukuranLubang' => 1,
        //     'bekasRoda' => 2,
        //     'kerusakanTepiKiri' => 1,
        //     'kerusakanTepiKanan' => 1,
        //     'kondisiBahuKanan' => 1,
        //     'kondisiBahuKiri' => 1,
        //     'permukaanBahuKiri' => 1,
        //     'permukaanBahuKanan' => 1,
        //     'kondisiSaluranKiri' => 2,
        //     'kondisiSaluranKanan' => 2,
        //     'kerusakanLerengKiri' => 1,
        //     'kerusakanLerengKanan' => 1,
        //     'trotoarKiri' => 2,
        //     'trotoarKanan' => 2,
        // ]);
        // AsphaltStreetData::create([
        //     'asphalt_street_id' => 2,
        //     'dariPatok' => '0+000',
        //     'jenisPerkerasan' => 'Aspal',
        //     'kePatok' => '0+100',
        //     'permukaanPerkerasan' => 2,
        //     'kondisi' => 1,
        //     'penurunan' => 1,
        //     'tambalan' => 1,
        //     'jenis' => 1,
        //     'lebar' => 1,
        //     'luas' => 1,
        //     'jumlahLubang' => 1,
        //     'ukuranLubang' => 1,
        //     'bekasRoda' => 2,
        //     'kerusakanTepiKiri' => 3,
        //     'kerusakanTepiKanan' => 1,
        //     'kondisiBahuKanan' => 4,
        //     'kondisiBahuKiri' => 2,
        //     'permukaanBahuKiri' => 3,
        //     'permukaanBahuKanan' => 3,
        //     'kondisiSaluranKiri' => 1,
        //     'kondisiSaluranKanan' => 1,
        //     'kerusakanLerengKiri' => 2,
        //     'kerusakanLerengKanan' => 1,
        //     'trotoarKiri' => 1,
        //     'trotoarKanan' => 1,
        // ]);
    }
}
