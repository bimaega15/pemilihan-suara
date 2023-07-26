<?php

namespace Database\Seeders;

use App\Models\Konfigurasi;
use Illuminate\Database\Seeder;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Konfigurasi::create([
            'nama_konfigurasi' => 'Sistem Pakar Diagnosa Kecanduan Anak Bermain Gadget Metode Naive Bayes',
            'logo_konfigurasi' => 'default.png',
            'nohp_konfigurasi' => '082277562382',
            'alamat_konfigurasi' => 'Pekanbaru',
            'email_konfigurasi' => 'rafli15@gmail.com',
            'deskripsi_konfigurasi' => 'Sistem Pakar Diagnosa dengan menggunakan metode Naive Bayes, Metode terbukti memberikan solusi yang tepat dalam memberikan solusi terhadap diagnosa anak yang memiliki riwayat kecanduan dalam bermain gadget, sehingga dengan adanya sistem ini, langsung cepat dan tanggap dalam memberikan solusi kepada target user yang bersangkutan',
            'created_konfigurasi' => 'Rafli @ TA',
            'longitude_konfigurasi' => '101.44904136657715',
            'latitude_konfigurasi' => '0.5255741678767475'
        ]);
    }
}
