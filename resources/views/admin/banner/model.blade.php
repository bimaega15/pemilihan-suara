 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Banner</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.banner.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="file" class="form-control gambar_banner" id="floatingInput" placeholder="Nama banner..." name="gambar_banner">
                         <small class="error_gambar_banner text-danger"></small>
                         <span id="load_gambar_banner"></span>
                     </div>
                     <small class="error_gambar_banner text-danger"></small>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <input type="text" class="form-control judul_banner" id="floatingInput" placeholder="Judul banner..." name="judul_banner">
                         <small class="error_judul_banner text-danger"></small>
                         <label for="floatingInput">Judul</label>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="form-floating">
                         <textarea type="text" class="form-control keterangan_banner" id="floatingInput" placeholder="Keterangan banner..." name="keterangan_banner" style="height: 100px;"></textarea>
                         <small class="error_keterangan_banner text-danger"></small>
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