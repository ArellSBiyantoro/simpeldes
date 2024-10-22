<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Informasi_pengurus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informasi')->insert([
            [
                'nama' => 'Suyitno',
                'jabatan' => 'Kepala Desa',
                'email' => 'suyitno@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Anjar Setiawan',
                'jabatan' => 'Sekertaris Desa',
                'email' => 'anjarsetiawan41@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Slamet Nur Wachid',
                'jabatan' => 'Kaur Tata Usaha Umum',
                'email' => 'slamet@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Musriyati',
                'jabatan' => 'Kaur Keuangan',
                'email' => 'musriyati@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rahma Asfiyatul Janah',
                'jabatan' => 'Kasi Pelayanan',
                'email' => 'rahma@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Asroni',
                'jabatan' => 'Kasi Kesejahteraan',
                'email' => 'asroni@gmail.com',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
