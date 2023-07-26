 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Bobot User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.kuisioner.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="id" class="id">
                 <div class="modal-body">
                     <div class="form-floating">
                         <input type="text" class="form-control kode_kuisioner" id="floatingInput" placeholder="Bobot user..." name="kode_kuisioner" readonly>
                         <small class="error_kode_kuisioner text-danger"></small>
                         <label for="floatingInput">Kode</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="text" class="form-control soal_kuisioner" id="floatingInput" placeholder="Pernyataan..." name="soal_kuisioner">
                         <small class="error_soal_kuisioner text-danger"></small>
                         <label for="floatingInput">Pernyataan</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea class="form-control definisi_kuisioner" id="floatingInput" placeholder="Definisi..." name="definisi_kuisioner"></textarea>
                         <small class="error_definisi_kuisioner text-danger"></small>
                         <label for="floatingInput">Definisi</label>
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