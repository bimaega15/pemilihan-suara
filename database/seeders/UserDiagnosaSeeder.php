<?php

namespace Database\Seeders;

use App\Models\Hasil;
use App\Models\HasilDetail;
use App\Models\UserDiagnosa;
use Illuminate\Database\Seeder;

class UserDiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getConvertId($bobot)
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
            'tanggal_user_diagnosa' => '2023-07-03',
            'judul_user_diagnosa' => 'Konsultasi Diagnosa',
            'nama_user_diagnosa' => 'rafli15',
            'jenis_kelamin_user_diagnosa' => 'L',
            'nomor_hp_user_diagnosa' => '082277506232',
            'email_user_diagnosa' => 'rafli15@gmail.com',
            'alamat_user_diagnosa' => 'JL. Manunggal',
            'usia_user_diagnosa' => 24
        ];
        $user_diagnosa_id = UserDiagnosa::create($data)->id;

        $data = [
            'user_diagnosa_id' => $user_diagnosa_id
        ];
        $hasil_id = Hasil::create($data)->id;


        $data = '1	1	0	1	0	1	0	0	1	1	0	0	2	3	3	2	3	2	3	1	2	2	2	1	2	1';
        $expData = explode('	', $data);

        $pushData = [];
        foreach ($expData as $key => $value) {
            $kuisioner_id = $key + 1;
            $jawaban_kuisioner_id = $this->getConvertId($value);
            $pushData[] = [
                'hasil_id' => $hasil_id,
                'kuisioner_id' => $kuisioner_id,
                'jawaban_kuisioner_id' => $jawaban_kuisioner_id,
            ];
        }
        HasilDetail::insert($pushData);
    }
}
