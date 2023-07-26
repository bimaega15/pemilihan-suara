<?php

namespace Database\Seeders;

use App\Models\RangeBobot;
use Illuminate\Database\Seeder;

class RangeBobotSeeder extends Seeder
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
                'dari_range_bobot' => '0',
                'sampai_range_bobot' => '33.33',
                'nama_range_bobot' => 'Ringan',
                'solusi_range_bobot' => 'Solusi Ringan',
            ],
            [
                'id' => 2,
                'dari_range_bobot' => '34',
                'sampai_range_bobot' => '66.33',
                'nama_range_bobot' => 'Sedang',
                'solusi_range_bobot' => 'Solusi Sedang',
            ],
            [
                'id' => 3,
                'dari_range_bobot' => '67',
                'sampai_range_bobot' => '100',
                'nama_range_bobot' => 'Berat',
                'solusi_range_bobot' => 'Solusi Berat',
            ],
        ];

        RangeBobot::insert($data);
    }
}
