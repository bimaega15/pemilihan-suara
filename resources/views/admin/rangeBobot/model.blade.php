 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Bobot User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.rangeBobot.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="id" class="id">
                 <div class="modal-body">
                     <div class="form-floating">
                         <input type="number" step="any" class="form-control dari_range_bobot" id="floatingInput" placeholder="Dari Range..." name="dari_range_bobot">
                         <small class="error_dari_range_bobot text-danger"></small>
                         <label for="floatingInput">Dari Range</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="number" step="any" class="form-control sampai_range_bobot" id="floatingInput" placeholder="Dari Range..." name="sampai_range_bobot">
                         <small class="error_sampai_range_bobot text-danger"></small>
                         <label for="floatingInput">Sampai Range</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="text" class="form-control nama_range_bobot" id="floatingInput" placeholder="Nama Range..." name="nama_range_bobot">
                         <small class="error_nama_range_bobot text-danger"></small>
                         <label for="floatingInput">Nama</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea class="form-control solusi_range_bobot" id="floatingInput" placeholder="Solusi..." name="solusi_range_bobot"></textarea>
                         <small class="error_solusi_range_bobot text-danger"></small>
                         <label for="floatingInput">Solusi</label>
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