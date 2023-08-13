 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Pendukung</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.pendukung.store') }}" class="form-submit">
                 <input type="hidden" name="tps_id" value="">
                 <input type="hidden" name="_method" value="post">
                 <input type="hidden" name="id" class="id" value="">
                 <input type="hidden" name="password_profile_old" class="password_profile_old" value="">
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="owl-carousel owl-theme">
                                 @include('admin.pendukung.item.biodata')
                                 @include('admin.pendukung.item.wilayah')
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="modalFormTps" aria-labelledby="modalFormTpsLabel" aria-hidden="true">
     <div class="modal-dialog modal-fullscreen">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormTpsLabel">Form TPS</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTableTps" style="width: 100%;">
                         <thead>
                             <tr>
                                 <th>No.</th>
                                 <th>TPS</th>
                                 <th>Alamat</th>
                                 <th>Wilayah</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                     </table>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                     <i data-feather="x"></i> OK
                 </button>
             </div>
         </div>
     </div>
 </div>