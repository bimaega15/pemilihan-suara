@extends('layouts.user')

@section('title')
Hasil Page
@endsection

@section('content')

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


<section class="page-title page-title-layout5 text-center">
    <div class="bg-img"><img src="{{ asset('frontend/medcity') }}/assets/images/backgrounds/6.jpg" alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">Detail Hasil</h1>
                <nav>
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/users/hasil') }}">Hasil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.page-title -->
<section class="services-layout1 services-carousel">
    <div class="bg-img"><img src="{{ asset('frontend/medcity/') }}/assets/images/backgrounds/4.png" alt="background">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-60">
                    <h2 class="heading__subtitle">Detail Hasil</h2>
                    <h3 class="heading__title">Perhitungan Diagnosa Anda:</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-book"></i> <strong>Detail Hasil</strong>
                            </div>
                            <div>
                                <button type="button" class="btn btn-dark btn-sm" id="print-button">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="area-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
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
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

@push('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '#print-button', function(e) {
            e.preventDefault();
            $.print("#area-print");
        })
    })
</script>
@endpush
@endsection