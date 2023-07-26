@extends('layouts.admin')
@section('title')
Hasil Detail
@endsection
@section('content')
<?php
$isCreate = session()->get('userAcess.is_create');
?>
@php
$kriteria = null;
foreach ($metode['data_training'] as $kuisioner_jawaban_id => $value) {
$kriteria = $value;
}

$setRangeBobot = null;
foreach ($metode['fiturTiapKelas'] as $kuisioner_id => $range) {
$setRangeBobot = $range;
}
@endphp

@push('css')
<style>
    @media print {
        body {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
@endpush


<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i data-feather="settings"></i> <strong>Data Hasil Detail</strong>
                            </div>
                            <div>
                                {{ Breadcrumbs::render('hasilDetail', $id) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" style="border-bottom: 1px solid black; padding-bottom: 10px;">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-dark" id="print-button">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px;" id="print-area">
                            <div class="col-lg-12">
                                <div>
                                    <h5>Data Training</h5>
                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Diagnosa</th>
                                                    @foreach ($kriteria as $kuisioner_id => $item)
                                                    <th>{{ Check::getKuisioner($kuisioner_id)->kode_kuisioner }}
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @foreach ($metode['data_training'] as $kuisioner_jawaban_id => $kuisioner)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ Check::getPernyataan($kuisioner_jawaban_id)->rangeBobot->nama_range_bobot }}
                                                    </td>
                                                    @foreach ($kuisioner as $kuisioner_id => $value)
                                                    <td>{{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h5>Data Testing</h5>
                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                @foreach ($metode['data_testing'] as $kuisioner_jawaban_id => $kuisioner)
                                                <td>{{ Check::getPernyataan($kuisioner_jawaban_id)->rangeBobot->nama_range_bobot }}
                                                </td>
                                                @foreach ($kuisioner as $kuisionre_id => $value)
                                                <td>{{ $value }}</td>
                                                @endforeach
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h5>Menghitung Prioritas Tiap Kelas</h5>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <table class="table table-bordered">
                                                @foreach ($metode['prioritas_tiap_kelas'] as $range_bobot_id => $item)
                                                <tr>
                                                    <td>{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}
                                                    </td>
                                                    <td>:</td>
                                                    <td>{{ $item }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-3">
                                    <h5>Mencari Likelihood</h5>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Diagnosa</th>
                                                    @foreach ($kriteria as $kuisioner_id => $item)
                                                    <th>{{ Check::getKuisioner($kuisioner_id)->kode_kuisioner }}
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($metode['likeIHood'] as $range_bobot_id => $kuisioner)
                                                <tr>
                                                    <td>{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}
                                                    </td>
                                                    @foreach ($kuisioner as $kuisioner_id => $value)
                                                    <td>{{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    @foreach ($setRangeBobot as $range_bobot_id => $item)
                                                    <th>F.{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}
                                                    </th>
                                                    @endforeach
                                                    @foreach ($setRangeBobot as $range_bobot_id => $item)
                                                    <th>Prob.{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}
                                                    </th>
                                                    @endforeach
                                                    @foreach ($setRangeBobot as $range_bobot_id => $item)
                                                    <th>LP.{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($metode['fiturTiapKelas'] as $kuisioner_id => $range)
                                                <tr>
                                                    <td>{{ Check::getKuisioner($kuisioner_id)->kode_kuisioner }}
                                                    </td>
                                                    @foreach ($range as $range_bobot_id => $value)
                                                    <td>{{ $value }}</td>
                                                    @endforeach
                                                    @foreach ($metode['probabilitas'][$kuisioner_id] as $range_bobot_id => $value)
                                                    <td>{{ number_format($value, 3) }}</td>
                                                    @endforeach
                                                    @foreach ($metode['LProbabilitas'][$kuisioner_id] as $range_bobot_id => $value)
                                                    <td>{{ number_format($value, 3) }}</td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <h5>Mencari Posterior</h5>
                                    <hr>
                                    <table class="table table-bordered mb-3">
                                        @foreach ($metode['posterior'] as $range_bobot_id => $value)
                                        <tr>
                                            <td>{{ Check::getRangeBobot($range_bobot_id)->nama_range_bobot }}</td>
                                            <td>:</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                        @endforeach
                                    </table>

                                    <h5>Hasil Diagnosa</h5>
                                    <hr>
                                    <p style="font-size: 16px">
                                        <strong>Nilai Max: <span class="text-success">{{ $metode['max'] }}</span>
                                        </strong> Maka dapat disimpulkan bahwa Pasien
                                        {{ Check::getHasil($id)->userDiagnosa->nama_user_diagnosa }} diagnosa:
                                        <strong class="text-danger">
                                            {{ Check::getRangeBobot($metode['diagnosa'])->nama_range_bobot }}</strong>
                                    </p>
                                    <p>Solusi: <br>
                                        {{ Check::getRangeBobot($metode['diagnosa'])->solusi_range_bobot }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '#print-button', function(e) {
            e.preventDefault();
            $.print('#print-area');
        })
    })
</script>
@endpush
@endsection