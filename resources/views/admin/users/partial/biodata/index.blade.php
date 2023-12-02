<div class="item" id="div_biodata">
    <h4>Biodata</h4>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="text" class="form-control nik_profile" id="floatingInput" placeholder="Nik..." name="nik_profile">
                <small class="error_nik_profile text-danger"></small>
                <label for="floatingInput">Nomor Induk</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                <select class="form-control jabatan_id select2" name="jabatan_id">
                    <option value="">Jabatan</option>
                    @foreach ($jabatan as $item)
                    <option value="{{ $item->id }}">{{$item->nama_jabatan}} - {{ $item->keterangan_jabatan }}</option>
                    @endforeach
                </select>
                <small class="error_jabatan_id text-danger"></small>
                <label for="floatingInput">Jabatan</label>
            </div>
        </div>
    </div>
    <div style="height: 10px;"></div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="text" class="form-control nama_profile" id="floatingInput" placeholder="Nama..." name="nama_profile">
                <small class="error_nama_profile text-danger"></small>
                <label for="floatingInput">Nama</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="text" class="form-control email_profile" id="floatingInput" placeholder="Email..." name="email_profile">
                <small class="error_email_profile text-danger"></small>
                <label for="floatingInput">Email</label>
            </div>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-floating">
                <input type="number" class="form-control nohp_profile" id="floatingInput" placeholder="No. HP..." name="nohp_profile">
                <small class="error_nohp_profile text-danger"></small>
                <label for="floatingInput">No. handphone</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-floating">
                <textarea class="form-control alamat_profile" id="floatingInput" placeholder="Alamat..." name="alamat_profile" style="height: 80px;"></textarea>
                <small class="error_alamat_profile text-danger"></small>
                <label for="floatingInput">Alamat</label>
            </div>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="jenis_kelamin_profile" class="form-label">Jenis
                    kelamin</label>
                <div class="form-check">
                    <input class="form-check-input jenis_kelamin_profile" type="radio" name="jenis_kelamin_profile" id="jenis_kelamin_profile_l" value="L">
                    <label class="form-check-label" for="jenis_kelamin_profile_l">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input jenis_kelamin_profile" type="radio" name="jenis_kelamin_profile" id="jenis_kelamin_profile_p" value="P">
                    <label class="form-check-label" for="jenis_kelamin_profile_p">
                        Perempuan
                    </label>
                </div>
                <small class="error_jenis_kelamin_profile text-danger"></small>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="formFile" class="form-label label-image-photo">Upload poto</label>
                <input class="form-control gambar_profile" type="file" id="formFile" name="gambar_profile">
                <span id="load_gambar_profile"></span>
                <small class="error_gambar_profile text-danger"></small>
            </div>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="form-group">
        <label for="">Status user</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="is_aktif" name="is_aktif">
            <label class="form-check-label" for="is_aktif">
                Apakah user ini aktif
            </label>
        </div>
    </div>
    <div style="height: 25px;"></div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end">
                <div>
                    <button type="submit" class="btn btn-primary btn-submit-users"><i data-feather="send"></i>
                        Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 50px;"></div>

</div>