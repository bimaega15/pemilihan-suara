<div class="row">
    <div class="col-lg-6">
        <div style="width: 100%;" class="card shadow">
            <div class="card-header">
                <h5><i class="fa-solid fa-house-user"></i> Keseluruhan Suara</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <canvas id="semua-suara-chart" class="mb-4"></canvas>
                        <div class="card shadow p-3">
                            <div class="progress" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ number_format($presentasePemenangan,2) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format($presentasePemenangan,2) }}%;/*! height: 50px; */"> {{ number_format($presentasePemenangan,2) }}%
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="fas fa-volume-down"></i> Target Pemenangan
                                </div>
                                <div>
                                    <span>{{ number_format($targetPemenangan) }} Suara</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <span><i class="fas fa-user"></i> Total dukungan: </span>
                            <h5 class="text-success font-weight-bold text-end mt-2">{{ number_format($totalDukungan, 0) }} Suara</h5>
                        </div>
                        <hr>
                        <div>
                            <span><i class="fas fa-user-tie"></i> Total Koordinator: </span>
                            <h5 class="text-success font-weight-bold text-end mt-2">{{ number_format($totalkoordinator, 0) }} C.O</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow" style="width: 100%;">
                            <div class="card-header">
                                <i class="fas fa-map-marker-alt"></i> Provinsi
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Provinsi TPS</h5>
                                <p class="card-text text-end font-weight-bold" style="font-size: 24px;">{{ number_format($provinsi, 0) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow" style="width: 100%;">
                            <div class="card-header">
                                <i class="fas fa-map-marker-alt"></i> Kabupaten
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Kabupaten TPS</h5>
                                <p class="card-text text-end font-weight-bold" style="font-size: 24px;">{{ number_format($kabupaten, 0) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow" style="width: 100%;">
                            <div class="card-header">
                                <i class="fas fa-map-marker-alt"></i> Kecamatan
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Kecamatan TPS</h5>
                                <p class="card-text text-end font-weight-bold" style="font-size: 24px;">{{ number_format($kecamatan, 0) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow" style="width: 100%;">
                            <div class="card-header">
                                <i class="fas fa-map-marker-alt"></i> Kelurahan
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Kelurahan TPS</h5>
                                <p class="card-text text-end font-weight-bold" style="font-size: 24px;">{{ number_format($kelurahan, 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div style="width: 100%;" class="card shadow">
            <div class="card-header">
                <h5><i class="fa-solid fa-house-user"></i> Total Dukung / Wilayah</h5>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Filter Berdasarkan</label>
                                <select class="form-control wilayah_all" name="wilayah_all">
                                    <option value="">Pilih Wilayah</option>
                                    <option value="provinces">Provinsi</option>
                                    <option value="regencies">Kabupaten</option>
                                    <option value="districts">Kecamatan</option>
                                    <option value="villages" selected>Kelurahan</option>
                                </select>
                                <small class="error_wilayah_all text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for=""></label>
                                <div style="height: 0px;"></div>
                                <a href="#" class="btn btn-light btn-filter-wilayah-all me-1">
                                    <i class="fas fa-search"></i> Filter
                                </a>
                                <a href="#" class="btn btn-light btn-reset-wilayah-all">
                                    <i class="fas fa-search"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-dashboard-wilayah">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Keluruhan</th>
                                <th>Total Dukungan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>