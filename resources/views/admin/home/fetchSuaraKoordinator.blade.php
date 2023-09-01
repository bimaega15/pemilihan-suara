<div class="row">
    <div class="col-lg-12 mx-auto">
        <div style="width: 100%;" class="card shadow">
            <div class="card-header">
                <h5><i data-feather="volume-2"></i> {{ $koordinatorTps->tps->nama_tps }}</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <i class="fa-solid fa-location-dot"></i> <b>Kelurahan :</b> {{ $koordinatorTps->tps->villages->name }}
                    </div>
                    <div class="col-lg-6">
                        <i class="fa-solid fa-location-dot"></i>
                        <b>Alamat : </b> {{ $koordinatorTps->tps->alamat_tps }}
                    </div>
                </div>
                <hr>
                <div style="height: 15px;"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <canvas id="chart-koordinator" class="mb-4"></canvas>

                        <div class="card shadow p-3">
                            <div class="progress" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ number_format($presentasePemenangan,2) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format($presentasePemenangan,2) }}%;">
                                    {{ round($presentasePemenangan) }}%
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="fas fa-volume-down"></i> Target Pemenangan TPS
                                </div>
                                <div>
                                    <span style="font-size: 18px; font-weight: bold;">{{ number_format($targetPemenangan) }} Suara</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <span><i class="fas fa-user"></i> Total dukungan: </span>
                            <h5 class="font-weight-bold text-end mt-2"><b>{{ number_format($totalDukungan, 0) }} Suara</b></h5>
                        </div>
                        <hr>
                        <div>
                            <span><i class="fa-solid fa-person"></i> Dukungan Laki-laki: </span>
                            <h5 class="font-weight-bold text-end mt-2"><b>{{ number_format($totalDukunganLk, 0) }} Suara</b></h5>
                        </div>
                        <hr>
                        <div>
                            <span><i class="fa-solid fa-person-dress"></i> Dukungan Perempuan: </span>
                            <h5 class="font-weight-bold text-end mt-2"><b>{{ number_format($totalDukunganPr, 0) }} Suara</b></h5>
                        </div>
                        <hr>
                        <div>
                            <span><i class="fas fa-user-tie"></i> Total Koordinator: </span>
                            <h5 class="font-weight-bold text-end mt-2"><b>{{ number_format($totalkoordinator, 0) }} Koordinator</b></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>