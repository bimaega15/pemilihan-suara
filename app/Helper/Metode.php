<?php

namespace App\Helper;

use App\Models\HasilDetail;
use App\Models\Pernyataan;
use App\Models\PernyataanDetail;
use App\Models\RangeBobot;

class Metode
{
    public function naiveBayes($id)
    {
        $hasilDetail = HasilDetail::with('hasil', 'kuisioner', 'jawabanKuisioner')->where('hasil_id', $id)->get();

        $metode = [];
        $dataTraining = [];
        $pernyataan = Pernyataan::with('rangeBobot')->get();

        foreach ($pernyataan as $key => $value) {
            $pernyataanDetail = PernyataanDetail::with('kuisioner', 'jawabanKuisioner', 'pernyataan')->where('pernyataan_id', $value->id)->get();

            foreach ($pernyataanDetail as $key => $item) {
                $dataTraining[$value->id][$item->kuisioner->id] = $item->jawabanKuisioner->bobot_jawaban_kuisioner;
            }
        }
        $setDataTraining = $dataTraining;
        $metode['data_training'] = $setDataTraining;

        $dataTesting = [];
        foreach ($hasilDetail as $key => $value) {
            $dataTesting[$value->kuisioner->id] = $value->jawabanKuisioner->bobot_jawaban_kuisioner;
        }
        $sumTraining = array_sum($dataTesting);
        $setDataTesting = $dataTesting;

        // range bobot
        $rangeBobot = RangeBobot::all();
        $dataTesting = [];
        foreach ($rangeBobot as $key => $value) {
            if ($value->dari_range_bobot <= $sumTraining && $sumTraining <= $value->sampai_range_bobot) {
                $dataTesting[$value->id] = $setDataTesting;
            }
        }
        $metode['data_testing'] = $dataTesting;


        // menghitung prioritas tiap kelas
        $countKelas = Pernyataan::all()->count();
        $getPernyataan = Pernyataan::all();
        $rangeBobotInclude = RangeBobot::all()->pluck('id')->toArray();

        $dataRangeBobot = [];
        foreach ($getPernyataan as $key => $value) {
            if (in_array($value->range_bobot_id, $rangeBobotInclude)) {
                $dataRangeBobot[$value->range_bobot_id][] = $value->range_bobot_id;
            }
        }

        // hasil menghitung prioritas tiap kelas
        $prioritasTiapKelas = [];
        foreach ($dataRangeBobot as $range_bobot_id => $value) {
            $prioritasTiapKelas[$range_bobot_id] = count($value) / $countKelas;
        }

        $metode['prioritas_tiap_kelas'] = $prioritasTiapKelas;



        $inversDataTraining = [];
        foreach ($setDataTraining as $pernyataan_id => $kuisioner) {
            foreach ($kuisioner as $kuisioner_id => $value) {
                $inversDataTraining[$kuisioner_id][$pernyataan_id] = $value;
            }
        }

        $likeIHood = [];
        foreach ($prioritasTiapKelas as $range_bobot_id => $value) {
            foreach ($dataTesting as $range_bobot_testing_id => $kuisioner) {

                // data testing
                foreach ($kuisioner as $kuisioner_id => $valueTesting) {
                    $totalNumber = 0;
                    foreach ($inversDataTraining[$kuisioner_id] as $pernyataan_id => $valueTraining) {
                        $get = Pernyataan::find($pernyataan_id);
                        $rangeBobotIdTraining = $get->range_bobot_id;

                        if ($range_bobot_id == $rangeBobotIdTraining && $valueTesting == $valueTraining) {
                            $totalNumber++;
                        }
                    }
                    $likeIHood[$range_bobot_id][$kuisioner_id] = $totalNumber;
                }
            }
        }
        $metode['likeIHood'] = $likeIHood;


        // invers like i hood
        $inversLikeIHood = [];
        foreach ($likeIHood as $range_bobot_id => $range) {
            foreach ($range as $kuisioner_id => $value) {
                $inversLikeIHood[$kuisioner_id][$range_bobot_id] = $value;
            }
        }
        $metode['fiturTiapKelas'] = $inversLikeIHood;

        // get kuisioner jawaban kuisioner
        $getPernyataanId = [];
        foreach ($setDataTraining as $pernyataanId => $value) {
            $getPernyataanId[] = $pernyataanId;
        }


        $probabilitas = [];
        foreach ($inversLikeIHood as $kuisioner_id => $range) {
            foreach ($range as $range_bobot_id => $value) {

                // search range bobot
                $totalNumber = 0;
                foreach ($getPernyataanId as $index => $item) {
                    $get = Pernyataan::find($item);
                    $rangeBobotIdTraining = $get->range_bobot_id;

                    if ($range_bobot_id == $rangeBobotIdTraining) {
                        $totalNumber++;
                    }
                }


                $calc = $value / $totalNumber;
                $probabilitas[$range_bobot_id][$kuisioner_id] = $calc;
            }
        }

        $inversProbabilitas = [];
        foreach ($probabilitas as $range_bobot_id => $kuisioner) {
            foreach ($kuisioner as $kuisioner_id => $value) {
                $inversProbabilitas[$kuisioner_id][$range_bobot_id] = $value;
            }
        }
        $metode['probabilitas'] = $inversProbabilitas;


        $lProbabilitas = [];
        foreach ($likeIHood as $range_bobot_id => $kuisioner) {
            foreach ($kuisioner as $kuisioner_id => $value) {
                if ($value == 0) {
                    $value = 0.001;
                }
                $lProbabilitas[$range_bobot_id][$kuisioner_id] = $value;
            }
        }
        $inversProbabilitas = [];
        foreach ($lProbabilitas as $range_bobot_id => $range) {
            foreach ($range as $kuisioner_id => $value) {
                $inversProbabilitas[$kuisioner_id][$range_bobot_id] = $value;
            }
        }

        $metode['LProbabilitas'] = $inversProbabilitas;

        function productWithScalar(array $values, array $prioritasByClass)
        {
            $output = [];
            foreach ($values as $range_bobot_id => $kuisioner) {
                $result = array_product($kuisioner);
                $calc = $result * $prioritasByClass[$range_bobot_id];
                $output[$range_bobot_id] = $calc;
            }

            return $output;
        }
        $getPosterior = productWithScalar($lProbabilitas, $prioritasTiapKelas);
        $metode['posterior'] = $getPosterior;

        $max = max($getPosterior);
        $metode['max'] = $max;

        $searchValue = array_search($max, $getPosterior);
        $metode['diagnosa'] = $searchValue;

        return $metode;
    }
}
