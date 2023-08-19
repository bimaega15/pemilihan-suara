 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Pendukung</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.pendukung.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="tps_id" value="{{ $tps_id }}">
                 <input type="hidden" name="users_id" value="">

                 <div class="modal-body" id="form-table">
                     <small class="error_users_id text-danger"></small>

                     <div class="table-respponsive">
                         <table class="table table-bordered" style="width: 100%;" id="dataTablePendukung">
                             <thead>
                                 <tr>
                                     <th></th>
                                     <th>
                                         <div class="form-check">
                                             <input class="form-check-input check-all" type="checkbox" value="" id="check-all" style="width: 18px; height: 18px;">
                                             <label class="form-check-label" for="check-all">
                                             </label>
                                         </div>
                                     </th>
                                     <th>No.</th>
                                     <th>NIK</th>
                                     <th>Nama</th>
                                     <th>Alamat</th>
                                     <th>Gambar</th>
                                 </tr>
                             </thead>
                         </table>
                     </div>
                     <div style="height: 10px;"></div>
                 </div>
                 <div class="modal-body d-none" id="form-edit">
                     <div class="form-group">
                         <label for="">Pilih Pendukung</label>
                         <select class="form-control users_id_select" id="floatingInput" name="users_id_select">
                             <option value="">-- Pilih Pendukung --</option>
                         </select>
                         <small class="error_users_id_select text-danger"></small>
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