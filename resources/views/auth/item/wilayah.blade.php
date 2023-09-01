<div class="item">
    <h4>Wilayah TPS</h4>
    <hr>
    <div class="mb-3">
        <a href="#" class="btn btn-outline-info m-b-xs detail-tps" style="border-color: #91C8E4 !important;">
            <i class="fas fa-arrow-right"></i> Pilih TPS
        </a>
    </div>
    <small class="error_tps_id text-danger"></small>

    <div class="d-flex justify-content-center d-none" id="outputTps">
        <input type="hidden" name="tps_id" class="tps_id" value="">
        <div class="card shadow" style="width: 35rem;">
            <div class="card-header p-3">
                <div class="d-flex justify-content-between align-items-center p-0">
                    <div>
                        <i class="fas fa-map-marker-alt"></i> <strong id="nama_tps"></strong>
                    </div>
                    <div>
                        <a href="#" class="btn btn-outline-danger m-b-xs btn-cancel-tps" style="border-color: #F11A7B !important;" data-id="">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <h5>
                    <span class="text-dark"> Kuota Koordinator: </span> <span id="kuota_tps"></span> <br>
                    <span class="text-dark"> Sudah terdaftar: </span> <span id="users_id"></span>
                </h5>
                <hr>
                <p class="card-text">

                    Kota / Kabupaten : <span id="districts_id"> Kisaran Barat</span> <br>
                    Kelurahan : <span id="villages_id"> Kisaran Baru </span> <br>
                    Lokasi TPS : <span id="alamat_tps"> JL. Diponegoro Gg. Nenas LK. VI Kisaran Baru </span>
                </p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center" id="outputNoData">
        <div class="card shadow" style="width: 35rem;">
            <div class="card-header p-3">
                <div class="d-flex  align-items-center p-0">
                    <div>
                        <i class="fas fa-location-arrow"></i> <strong>Informasi TPS</strong>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="text-center">
                    <i class="fas fa-info-circle fa-2x"></i> <br>
                    <div style="height: 30px;"></div>
                    <span class="text-dark">
                        Belum Memilih TPS
                    </span>
                </h5>
            </div>
        </div>
    </div>


    <div class="row" style="height: 70px;">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-dark m-b-xs customPrevBtn"> <i data-feather="arrow-left"></i> Sebelumnya</button>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-submit"><i data-feather="send"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>