 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form TPS</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.tps.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="">Provinsi</label>
                                 <select class="form-control provinces_id" name="provinces_id">
                                     <option value="">Pilih Provinsi</option>
                                 </select>
                                 <small class="error_provinces_id text-danger"></small>

                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="">Kabupaten</label>
                                 <select class="form-control regencies_id" name="regencies_id">
                                     <option value="">Pilih Kabupaten</option>
                                 </select>
                                 <small class="error_regencies_id text-danger"></small>

                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="">Kecamatan</label>
                                 <select class="form-control districts_id" name="districts_id">
                                     <option value="">Pilih Kecamatan</option>
                                 </select>
                                 <small class="error_districts_id text-danger"></small>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <label for="">Kelurahan</label>
                                 <select class="form-control villages_id" name="villages_id">
                                     <option value="">Pilih Kelurahan</option>
                                 </select>
                                 <small class="error_villages_id text-danger"></small>
                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-floating">
                                 <input class="form-control nama_tps" id="floatingInput" name="nama_tps" />
                                 <small class="error_nama_tps text-danger"></small>
                                 <label for="floatingInput">Nama TPS</label>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-floating">
                                 <input type="number" class="form-control minimal_tps" id="floatingInput" name="minimal_tps" />
                                 <small class="error_minimal_tps text-danger"></small>
                                 <label for="floatingInput">Minimal TPS</label>
                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <select class="form-control users_id" id="floatingInput" name="users_id">
                             <option value="">Pilih Koordinator</option>
                         </select>
                         <small class="error_users_id text-danger"></small>
                         <label for="floatingInput">Koordinator</label>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="x"></i>
                         Close</button>
                     <button type="submit" class="btn btn-primary"><i data-feather="send"></i>
                         Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>