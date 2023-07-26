<?php

namespace Database\Seeders;

use App\Models\Pernyataan;
use App\Models\PernyataanDetail;
use Illuminate\Database\Seeder;

class PernyataanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    function getConvertId($bobot)
    {
        $output = '';
        switch ($bobot) {
            case '3':
                $output = '1';
                break;
            case '2':
                $output = '2';
                break;
            case '1':
                $output = '3';
                break;
            case '0':
                $output = '4';
                break;
        }

        return $output;
    }

    public function run()
    {
        //
        $data = [
            [
                'id' => 1,
                'kode_pernyataan' => 'KJ001',
                'nama_pernyataan' => 'ringan',
                'range_bobot_id' => '1',
            ],
            [
                'id' => 2,
                'kode_pernyataan' => 'KJ002',
                'nama_pernyataan' => 'ringan',
                'range_bobot_id' => '1',
            ],
            [
                'id' => 3,
                'kode_pernyataan' => 'KJ003',
                'nama_pernyataan' => 'ringan',
                'range_bobot_id' => '1',
            ],
            [
                'id' => 4,
                'kode_pernyataan' => 'KJ004',
                'nama_pernyataan' => 'sedang',
                'range_bobot_id' => '2',
            ],
            [
                'id' => 5,
                'kode_pernyataan' => 'KJ005',
                'nama_pernyataan' => 'sedang',
                'range_bobot_id' => '2',
            ],
            [
                'id' => 6,
                'kode_pernyataan' => 'KJ006',
                'nama_pernyataan' => 'sedang',
                'range_bobot_id' => '2',
            ],
            [
                'id' => 7,
                'kode_pernyataan' => 'KJ007',
                'nama_pernyataan' => 'berat',
                'range_bobot_id' => '3',
            ],
            [
                'id' => 8,
                'kode_pernyataan' => 'KJ008',
                'nama_pernyataan' => 'sedang',
                'range_bobot_id' => '2',
            ],
            [
                'id' => 9,
                'kode_pernyataan' => 'KJ009',
                'nama_pernyataan' => 'berat',
                'range_bobot_id' => '3',
            ],
            [
                'id' => 10,
                'kode_pernyataan' => 'KJ010',
                'nama_pernyataan' => 'berat',
                'range_bobot_id' => '3',
            ],
        ];
        Pernyataan::insert($data);


        // 1
        $data = '1	1	0	1	0	1	0	0	1	1	0	0	1	0	0	1	1	0	1	1	1	1	0	1	1	1';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '1';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 2
        $data = '1	0	1	0	0	0	0	1	0	0	0	1	1	1	1	0	0	0	1	1	0	0	1	0	1	0';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '2';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 3
        $data = '1	0	1	1	1	0	0	0	0	0	0	0	1	1	1	0	0	1	1	0	0	1	1	0	1	0';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '3';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 4
        $data = '1	2	1	2	2	1	1	1	2	1	1	1	1	1	2	2	2	1	1	1	2	2	2	1	2	1';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '4';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 5
        $data = '2	1	2	2	1	2	2	1	1	1	1	2	2	1	1	2	1	1	2	2	1	2	1	1	2	2';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '5';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 6
        $data = '2	1	2	1	1	1	2	1	1	1	2	1	2	1	2	2	2	1	1	1	2	1	1	1	2	1';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '6';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 7
        $data = '2	2	3	3	3	3	2	3	3	2	2	3	2	3	3	2	3	2	3	3	2	2	3	2	3	3';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '7';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 8
        $data = '0	3	3	3	3	3	3	3	3	2	3	3	2	2	2	2	2	2	3	3	3	2	2	3	3	3';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '8';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 9
        $data = '3	3	3	3	3	3	3	3	3	3	2	3	3	3	2	3	2	2	3	2	3	3	3	3	2	3';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '9';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);

        // 10
        $data = '3	3	3	3	3	3	3	3	3	3	3	3	3	2	2	3	2	3	2	3	2	2	2	3	2	2';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pernyataan_id = '10';
            $pushData[] = [
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
                'pernyataan_id' => $pernyataan_id,
            ];
        }
        PernyataanDetail::insert($pushData);
    }
}
