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
                 <input type="hidden" name="password_old" class="password_old" value="">
                 <input type="hidden" name="role_id" class="role_id" value="">

                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link active" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">Account</button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="pills-wilayah-tab" data-bs-toggle="pill" data-bs-target="#pills-wilayah" type="button" role="tab" aria-controls="pills-wilayah" aria-selected="false">Wilayah</button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <button class="nav-link" id="pills-biodata-tab" data-bs-toggle="pill" data-bs-target="#pills-biodata" type="button" role="tab" aria-controls="pills-biodata" aria-selected="false">Biodata</button>
                                 </li>
                             </ul>
                             <div class="tab-content" id="pills-tabContent">
                                 <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
                                     @include('admin.users.partial.account.index')
                                 </div>
                                 <div class="tab-pane fade" id="pills-wilayah" role="tabpanel" aria-labelledby="pills-wilayah-tab">
                                     @include('admin.users.partial.wilayah.index')
                                 </div>
                                 <div class="tab-pane fade" id="pills-biodata" role="tabpanel" aria-labelledby="pills-biodata-tab">
                                     @include('admin.users.partial.biodata.index')
                                 </div>
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