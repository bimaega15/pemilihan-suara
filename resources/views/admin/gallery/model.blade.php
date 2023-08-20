 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Gallery</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.gallery.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-floating">
                         <input type="text" class="form-control waktu_gallery" id="datetimepicker" placeholder="Waktu gallery..." name="waktu_gallery">
                         <small class="error_waktu_gallery text-danger"></small>
                         <label for="datetimepicker">Waktu</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-group">
                         <input type="file" class="form-control gambar_gallery" id="floatingInput" placeholder="Gambar banner..." name="gambar_gallery">
                         <small class="error_gambar_gallery text-danger"></small>
                         <span id="load_gambar_gallery"></span>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="text" class="form-control judul_gallery" id="floatingInput" placeholder="Judul gallery..." name="judul_gallery">
                         <small class="error_judul_gallery text-danger"></small>
                         <label for="floatingInput">Judul</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea type="text" class="form-control keterangan_gallery" id="floatingInput" placeholder="Keterangan gallery..." name="keterangan_gallery" style="height: 100px;"></textarea>
                         <small class="error_keterangan_gallery text-danger"></small>
                         <label for="floatingInput">Keterangan</label>
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