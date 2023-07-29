 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Kabupaten</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.kecamatan.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-floating">
                         <select class="form-control regency_id" id="floatingInput" name="regency_id">
                             <option value="">-- Kabupaten --</option>
                         </select>
                         <small class="error_regency_id text-danger"></small>
                         <label for="floatingInput">Kabupaten</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="text" class="form-control name" id="floatingInput" placeholder="Nama kecamatan..." name="name">
                         <small class="error_name text-danger"></small>
                         <label for="floatingInput">Nama kecamatan</label>
                     </div>
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