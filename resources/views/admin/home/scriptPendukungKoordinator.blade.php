<script>
    $(document).ready(function() {
        var table = $('#dataTablePendukungCo')
            .DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                search: {
                    caseInsensitive: true,
                },
                searchHighlight: true,
                ajax: {
                    url: "{{ route('admin.home.pendukungKoordinator') }}",
                    type: 'get',
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                    },
                    {
                        data: "users.profile.nama_profile",
                        name: "users.profile.nama_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.jenis_kelamin_profile",
                        name: "users.profile.jenis_kelamin_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.nik_profile",
                        name: "users.profile.nik_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.nohp_profile",
                        name: "users.profile.nohp_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.alamat_profile",
                        name: "users.profile.alamat_profile",
                        searchable: true
                    },
                    {
                        data: "tps_status_view",
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(settings) {
                    var info = table.page.info();
                    table
                        .column(0, {
                            search: "applied",
                            order: "applied"
                        })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = info.start + i + 1;
                        });
                },
            });
    })
</script>