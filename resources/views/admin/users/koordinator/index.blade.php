@if ($isCreate != null)
<div class="mb-3">
    <a data-bs-toggle="modal" data-bs-target="#modalForm" href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-add" data-roles="koordinator">
        <i data-feather="plus"></i> Tambah
    </a>
</div>
@endif
<div class="table-responsive">
    <table class="table" id="dataTableKoordinator" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">
                    Username
                </th>
                <th scope="col">
                    Nama
                </th>
                <th scope="col">
                    Email
                </th>
                <th scope="col">
                    No. HP
                </th>
                <th scope="col" style="width: 40px;">
                    Gambar
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