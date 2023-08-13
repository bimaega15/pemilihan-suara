 <!-- Modal -->
 <div class="modal fade" id="modalForm" aria-labelledby="modalFormLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalFormLabel">Form Pendukung</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.pendukung.store') }}" class="form-submit">
                 <input type="hidden" name="tps_id" class="tps_id" value="">
                 <input type="hidden" name="_method" class="_method" value="post">
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
                 <div class="mb-3">
                     <div class="row">
                         <div class="col-lg-12">
                             <a href="#" class="btn btn-light btn-reset-wilayah me-1">
                                 <i class="fas fa-redo"></i> Reset
                             </a>
                             <a href="#" class="btn btn-dark btn-search-wilayah me-1">
                                 <i class="fas fa-search"></i> Cari
                             </a>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="">Provinsi</label>
                                 <select class="form-control provinces_id" name="provinces_id">
                                     <option value="">Pilih Provinsi</option>
                                 </select>
                                 <small class="error_provinces_id text-danger"></small>
                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="">Kabupaten</label>
                                 <select class="form-control regencies_id" name="regencies_id">
                                     <option value="">Pilih Kabupaten</option>
                                 </select>
                                 <small class="error_regencies_id text-danger"></small>

                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="">Kecamatan</label>
                                 <select class="form-control districts_id" name="districts_id">
                                     <option value="">Pilih Kecamatan</option>
                                 </select>
                                 <small class="error_districts_id text-danger"></small>
                             </div>
                         </div>
                         <div class="col-lg-3">
                             <div class="form-group">
                                 <label for="">Kelurahan</label>
                                 <select class="form-control villages_id" name="villages_id">
                                     <option value="">Pilih Kelurahan</option>
                                 </select>
                                 <small class="error_villages_id text-danger"></small>
                             </div>
                         </div>
                     </div>
                 </div>
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
                     <i class="fas fa-check"></i> OK
                 </button>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="modalDetailLabel">Detail Pendukung</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Home</button>
                     </li>
                     <li class="nav-item" role="presentation">
                         <button class="nav-link" id="wilayah-tab" data-bs-toggle="tab" data-bs-target="#wilayah" type="button" role="tab" aria-controls="wilayah" aria-selected="false">Wilayah </button>
                     </li>
                 </ul>
                 <div class="tab-content" id="myTabDetailPendukung">
                     @include('admin.pendukung.detail.biodata')
                     @include('admin.pendukung.detail.wilayah')
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                     <i class="fas fa-check"></i> OK
                 </button>
             </div>
         </div>
     </div>
 </div>