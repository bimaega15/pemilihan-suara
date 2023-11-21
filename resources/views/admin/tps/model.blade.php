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
                     @if (!$isExist)
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
                     @endif

                     @if ($isExist)
                     <div class="row">
                         <div class="col-lg-12">
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
                     @endif

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
                                 <label for="floatingInput">Minimum Koordinator</label>
                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="form-floating">
                                 <input type="number" class="form-control pendukung_tps" id="floatingInput" name="pendukung_tps" />
                                 <small class="error_pendukung_tps text-danger"></small>
                                 <label for="floatingInput">Minimum Pendukung</label>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-floating">
                                 <input type="number" class="form-control kuota_tps" id="floatingInput" name="kuota_tps" />
                                 <small class="error_kuota_tps text-danger"></small>
                                 <label for="floatingInput">Kuota Koordinator</label>
                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea placeholder="Alamat tps..." class="form-control alamat_tps" id="floatingInput" name="alamat_tps" rows="3">
                         </textarea>
                         <small class="error_alamat_tps text-danger"></small>
                         <label for="floatingInput">Alamat TPS</label>
                     </div>
                     <div style="height: 10px;"></div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="x"></i>
                         Close</button>
                     <button type="submit" class="btn btn-primary btn-submit"><i data-feather="send"></i>
                         Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="modalFormKoordinator" aria-labelledby="modalFormKoordinatorLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormKoordinatorLabel">Form Koordinator</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="#" class="form-submit-koordinator">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label for="">Koordinator</label>
                                 <select class="form-control users_id" name="users_id[]" multiple="multiple">
                                     <option value="">Pilih Koordinator</option>
                                 </select>
                                 <small class="error_users_id text-danger"></small>
                             </div>
                         </div>
                     </div>
                     <div style="height: 10px;"></div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather="x"></i>
                         Close</button>
                     <button type="submit" class="btn btn-primary btn-submit-koordinator"><i data-feather="send"></i>
                         Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>