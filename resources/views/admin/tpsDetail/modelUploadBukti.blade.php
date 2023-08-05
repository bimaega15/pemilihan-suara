<!-- Modal -->
<div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadLabel">Upload Bukti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" class="form-submit-upload" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Upload bukti relawan sudah mencoblos</label>
                        <input type="file" class="bukticoblos_detail form-control" name="bukticoblos_detail">
                        <small class="error_bukticoblos_detail text-danger"></small>
                        <div id="load-bukticoblos_detail"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-submit-upload"> <i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>