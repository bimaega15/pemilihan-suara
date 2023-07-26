<?php

namespace Database\Seeders;

use App\Models\JawabanKuisioner;
use Illuminate\Database\Seeder;

class JawabanKuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id' => 1,
                'kode_jawaban_kuisioner' => 'J001',
                'nama_jawaban_kuisioner' => 'Sangat Setuju',
                'definisi_jawaban_kuisioner' => 'SS',
                'bobot_jawaban_kuisioner' => '3',
            ],
            [
                'id' => 2,
                'kode_jawaban_kuisioner' => 'J002',
                'nama_jawaban_kuisioner' => 'Setuju',
                'definisi_jawaban_kuisioner' => 'S',
                'bobot_jawaban_kuisioner' => '2',
            ],
            [
                'id' => 3,
                'kode_jawaban_kuisioner' => 'J003',
                'nama_jawaban_kuisioner' => 'Tidak Setuju',
                'definisi_jawaban_kuisioner' => 'TS',
                'bobot_jawaban_kuisioner' => '1',
            ],
            [
                'id' => 4,
                'kode_jawaban_kuisioner' => 'J004',
                'nama_jawaban_kuisioner' => 'Sangat Tidak Setuju',
                'definisi_jawaban_kuisioner' => 'STS',
                'bobot_jawaban_kuisioner' => '0',
            ],
        ];

        JawabanKuisioner::insert($data);
    }
}
