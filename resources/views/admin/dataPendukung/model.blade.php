 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Pendukung</h5>
                 <button type="button" class="btn-close-modal btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="formFile" class="form-label">Upload Bukti Pendukung</label>
                         <input class="form-control pendukungcoblos_tps" type="file" id="formFile" name="pendukungcoblos_tps">
                         <span id="load_pendukungcoblos_tps"></span>
                         <small class="error_pendukungcoblos_tps text-danger"></small>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary btn-close-modal" data-bs-dismiss="modal"><i data-feather="x"></i>
                         Close</button>
                     <button type="submit" class="btn btn-primary btn-submit"><i data-feather="send"></i>
                         Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="modalPencarian" aria-labelledby="modalPencarianLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalPencarianLabel">Form Pencarian Pendukung</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="" class="form-submit-pencarian">
                 <input type="hidden" name="_method" value="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="">Masukan Nama / NIK / Email</label>
                         <select class="form-control users_id_select" id="floatingInput" name="users_id_select">
                             <option value="">-- Pilih Pendukung --</option>
                         </select>
                         <small class="error_users_id_select text-danger"></small>
                     </div>
                     <div style="height: 10px;"></div>
                     <div id="table_select_user">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>Nama</th>
                                     <th>NIK</th>
                                     <th>No. HP</th>
                                     <th>Email</th>
                                     <th>Alamat</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody id="loadTableSearch">
                                 <tr>
                                     <td colspan="6">
                                         <div class="text-center">
                                             <strong>
                                                 Belum pilih pendukung
                                             </strong>
                                         </div>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <div style="height: 30px;"></div>
                 </div>
             </form>
         </div>
     </div>
 </div>