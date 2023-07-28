 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Jabatan</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.jabatan.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-floating">
                         <input type="text" class="form-control nama_jabatan" id="floatingInput" placeholder="Nama jabatan..." name="nama_jabatan">
                         <small class="error_nama_jabatan text-danger"></small>
                         <label for="floatingInput">Nama jabatan</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea class="form-control keterangan_jabatan" id="floatingInput" placeholder="Keterangan jabatan..." name="keterangan_jabatan" style="height: 100px;"></textarea>
                         <small class="error_keterangan_jabatan text-danger"></small>
                         <label for="floatingInput">Keterangan</label>
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