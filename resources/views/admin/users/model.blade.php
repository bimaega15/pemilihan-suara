 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form profile</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.profile.store') }}" class="form-submit">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="id" class="id" value="">
                 <input type="hidden" name="password_profile_old" class="password_profile_old" value="">
                 <input type="hidden" name="role_id" class="role_id" value="">

                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="owl-carousel owl-theme">
                                 @include('admin.users.partial.account.index')
                                 @include('admin.users.partial.biodata.index')
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="modalImport" aria-labelledby="modalImportLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalImportLabel">Form Import</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.users.import') }}" class="form-submit-import">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="roles" value="">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label for="">Import File</label>
                                 <input type="file" class="form-control file_import" name="file_import">
                                 <small class="text-danger error_file_import"></small>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="modal-footer">
                     <a href="{{ asset('assets/pendukung-import.xlsx') }}"> <button type="button" class="btn btn-primary"><i data-feather="download"></i>
                             Unduh File Contoh</button></a>
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i data-feather="x"></i>
                         Close</button>
                     <button type="submit" class="btn btn-success btn-submit-import"><i data-feather="send"></i>
                         Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>