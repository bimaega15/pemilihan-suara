<div class="card mt-2">
    <div class="card-header">
        <i data-feather="monitor"></i> <strong>
            Progress Pemenangan Suara
        </strong>
    </div>
    <div class="card-body">
        <div class="row mb-4" id="filter_progres">
            <div class="col-lg-12 mb-2">
                <button type="button" class="btn btn-reset-progres btn-dark">
                    <i class="fa-solid fa-rotate-right"></i> Reset
                </button>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="">Provinsi</label>
                    <select name="provinces_id" class="form-control provinces_id" id="" style="width: 100%;">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="">Kabupaten</label>
                    <select name="regencies_id" class="form-control regencies_id" id="" style="width: 100%;">
                        <option value="">Pilih Kabupaten</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="">Kecamatan</label>
                    <select name="districts_id" class="form-control districts_id" id="" style="width: 100%;">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="">Kelurahan</label>
                    <select name="villages_id" class="form-control villages_id" id="" style="width: 100%;">
                        <option value="">Pilih Kelurahan</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div id="output_progres">

        </div>
    </div>
</div>