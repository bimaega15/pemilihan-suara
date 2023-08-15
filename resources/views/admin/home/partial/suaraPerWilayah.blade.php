<div class="row">
    <div class="col-lg-12">
        <a href="#" class="btn btn-light btn-reset-wilayah me-1">
            <i class="fas fa-redo"></i> Reset
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Provinsi</label>
            <select class="form-control provinces_id" name="provinces_id">
                <option value="">Pilih Provinsi</option>
            </select>
            <small class="error_provinces_id text-danger"></small>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Kabupaten</label>
            <select class="form-control regencies_id" name="regencies_id">
                <option value="">Pilih Kabupaten</option>
            </select>
            <small class="error_regencies_id text-danger"></small>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Kecamatan</label>
            <select class="form-control districts_id" name="districts_id">
                <option value="">Pilih Kecamatan</option>
            </select>
            <small class="error_districts_id text-danger"></small>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Kelurahan</label>
            <select class="form-control villages_id" name="villages_id">
                <option value="">Pilih Kelurahan</option>
            </select>
            <small class="error_villages_id text-danger"></small>
        </div>
    </div>
</div>
<div class="mt-3" id="output_grafik">
</div>