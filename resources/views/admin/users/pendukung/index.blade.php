@if ($isCreate != null)
<div class="mb-3">
    <a data-bs-toggle="modal" data-bs-target="#modalForm" href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-add me-1" data-roles="pendukung">
        <i data-feather="plus"></i> Tambah
    </a>
    <a data-bs-toggle="modal" data-bs-target="#modalImport" href="{{ url('/admin/users/create') }}" class="btn btn-success btn-import" data-roles="pendukung">
        <i class="fas fa-file-excel"></i> Import
    </a>
</div>
@endif
<div class="table-responsive">
    <table class="table" id="table-pendukung" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">
                    Nama
                </th>
                <th scope="col">
                    Jenis Kelamin
                </th>
                <th scope="col">
                    No. HP
                </th>
                <th scope="col">
                    Alamat
                </th>
                <th scope="col" style="width: 40px;">
                    KTP
                </th>
                <th>Is Aktif</th>

                <th scope="col">
                    <div class="text-center">
                        Actions
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>