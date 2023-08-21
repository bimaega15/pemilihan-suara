<script>
    $(document).ready(function(e) {
        var tablePendukung = $('#dataTablePendukung').DataTable({
            serverSide: true,
            processing: true,
            searching: true,
            search: {
                caseInsensitive: true,
            },
            searchHighlight: true,
            ajax: {
                url: "{{ route('admin.pendukung.usersPendukung') }}",
                dataType: 'json',
                type: 'get',
            },
            columns: [{
                    data: "collapse",
                    orderable: false,
                    className: 'details-control'
                },
                {
                    data: 'check-input',
                    name: 'check-input',
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "nik_profile",
                    name: "nik_profile",
                    searchable: false
                },
                {
                    data: "nama_profile",
                    name: "nama_profile",
                    searchable: false
                },
                {
                    data: "alamat_profile",
                    name: "alamat_profile",
                    searchable: false
                },
                {
                    data: "gambar_profile",
                    name: "gambar_profile",
                    searchable: false,
                    orderable: false,
                },
            ],
            drawCallback: function(settings) {
                var info = tablePendukung.page.info();
                tablePendukung
                    .column(2, {
                        search: "applied",
                        order: "applied"
                    })
                    .nodes()
                    .each(function(cell, i) {
                        cell.innerHTML = info.start + i + 1;
                    });
            },
        });

        $('#dataTablePendukung tbody').on('click', 'td.details-control .btn-show-users', function() {
            var tr = $(this).closest('tr');
            var row = tablePendukung.row(tr);

            if (row.child.isShown()) {
                // Baris sudah terbuka, tutup
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        $(document).on('click', '.btn-show-users', function(e) {
            e.preventDefault();
            let data = $(this).data('type');
            if (data == 'plus') {
                $(this).data('type', 'minus');
                $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
            } else {
                $(this).data('type', 'plus');
                $(this).find('i').removeClass('fa-minus').addClass('fa-plus');
            }
        })

        function format(rowData) {
            return `
            <div class="row">
                     <div class="col-lg-6">
                         <h5>Users Acount</h5>
                         <hr>
                         <table class="w-100">
                             <tr>
                                 <td>Username</td>
                                 <td>:</td>
                                 <td><span id="username">${rowData.username}</span></td>
                             </tr>
                             <tr>
                                 <td>Status Aktif</td>
                                 <td>:</td>
                                 <td><span id="is_aktif">
                                       ${rowData.is_aktif == 1 ? `<i class="fas fa-check text-success"></i>` : `
                                        <i class="fas fa-times text-danger"></i>` }  
                                     </span>
                                     </td>
                             </tr>
                             <tr>
                                 <td>Status Pendaftaran TPS</td>
                                 <td>:</td>
                                 <td><span id="is_registps">
                                 ${rowData.is_registps == 1 ? `<i class="fas fa-check text-success"></i>` : `
                                        <i class="fas fa-times text-danger"></i>` }  
                                     </span></td>
                             </tr>
                         </table>
                    </div>
                    <div class="col-lg-6">
                        <h5>Biodata Pendukung</h5>
                            <hr>
                            <table class="w-100">
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td><span id="nik_profile">${rowData.nik_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><span id="nama_profile">${rowData.nama_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><span id="email_profile">${rowData.email_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><span id="alamat_profile">${rowData.alamat_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td><span id="nohp_profile">${rowData.nohp_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><span id="jenis_kelamin_profile">
                                    ${rowData.jenis_kelamin_profile == 'L' ? 'Laki-laki' : 'Perempuan'}
                                    </span></td>
                                </tr>
                                <tr>
                                    <td>Gambar profile</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span id="gambar_profile">
                                            ${rowData.gambar_profile}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    </div>
            </div>
            `;
        }

        var table = $('#dataTable')
            .DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                search: {
                    caseInsensitive: true,
                },
                searchHighlight: true,
                ajax: {
                    url: "{{ route('admin.pendukung.index') }}",
                    type: 'get',
                    data: {
                        tps_id: "{{ $tps_id }}"
                    }
                },
                columns: [{
                        data: "collapse_primary",
                        name: "collapse_primary",
                        orderable: false,
                        searchable: false,
                        className: 'details-control-primary'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                    },
                    {
                        data: "users.username",
                        name: "users.username",
                        searchable: true
                    },
                    {
                        data: "users.profile.nik_profile",
                        name: "users.profile.nik_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.nama_profile",
                        name: "users.profile.nama_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.alamat_profile",
                        name: "users.profile.alamat_profile",
                        searchable: true
                    },
                    {
                        data: "users.profile.nohp_profile",
                        name: "users.profile.nohp_profile",
                        searchable: true
                    },
                    {
                        data: "jenis_kelamin_profile",
                        name: "jenis_kelamin_profile",
                        searchable: true
                    },
                    {
                        data: "gambar_profile",
                        name: "gambar_profile",
                        searchable: true
                    },
                    {
                        data: "action",
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(settings) {
                    var info = table.page.info();
                    table
                        .column(1, {
                            search: "applied",
                            order: "applied"
                        })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = info.start + i + 1;
                        });
                },
                rowCallback: function(row, data, index) {
                    if ((data.verificationcoblos_tps) == null && data.users_id_koordinator == null) {
                        $(row).addClass('bg-secondary');
                        $('td', row).css({
                            color: '#000',
                            fontWeight: '400'
                        });
                    }
                    if ((data.verificationcoblos_tps) == null && data.users_id_koordinator != null) {
                        $(row).addClass('bg-info');
                        $('td', row).css({
                            color: '#000',
                            fontWeight: '400'
                        });
                    }
                    if (data.verificationcoblos_tps == 1) {
                        $(row).addClass('bg-success');
                        $('td', row).css({
                            color: '#000',
                            fontWeight: '400'
                        });
                    }
                    if (data.verificationcoblos_tps == 0) {
                        $(row).addClass('bg-danger');
                        $('td', row).css({
                            color: '#000',
                            fontWeight: '400'
                        });
                    }
                }
            });

        $('#dataTable tbody').on('click', 'td.details-control-primary .btn-show-users', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // Baris sudah terbuka, tutup
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format_primary(row.data())).show();
                tr.addClass('shown');
            }
        });


        function format_primary(rowData) {
            const root = "{{ asset('/') }}";

            let gambar_profile = rowData.users.profile.gambar_profile;
            if (rowData.users.profile.gambar_profile == 'default.png') {
                // my profile
                let linkGambar =
                    `${root}upload/profile/${rowData.users.profile.gambar_profile}`;
                gambar_profile = `
        <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${rowData.users.profile.gambar_profile}">
            <img class="img-thumbnail" width="100px;" src="${linkGambar}"></img>    
        </a>
        `;
            }


            // upload bukti pendukung
            let linkGambar =
                `${root}upload/tps/${rowData.pendukungcoblos_tps}`;

            let pendukungcoblos_tps = `
        <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${rowData.pendukungcoblos_tps}">
            <img class="img-thumbnail" width="100px;" src="${linkGambar}"></img>    
        </a>
        `;
            if (rowData.pendukungcoblos_tps == 'default.png' || rowData.pendukungcoblos_tps == null) {
                let linkGambar =
                    `${root}upload/tps/default.png`;
                pendukungcoblos_tps = `
        <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="default.png">
            <img class="img-thumbnail" width="100px;" src="${linkGambar}"></img>    
        </a>
        `;
            }

            // status verifikasi
            let spanVerification = null;
            if ((rowData.verificationcoblos_tps) == null && rowData.pendukungcoblos_tps != null && rowData.pendukungcoblos_tps != 'default.png') {
                spanVerification = `
                <a class="btn btn-success btn-sm me-1 btn-verify" data-id="${rowData.id}" data-verificationcoblos_tps="1" title="Verifikasi">
                    <i class="fas fa-check"></i>
                </a>
                <a class="btn btn-danger btn-sm btn-verify" data-id="${rowData.id}" data-verificationcoblos_tps="0" title="Ditolak">
                    <i class="fas fa-times"></i>
                </a>
    `;
            }

            if ((rowData.verificationcoblos_tps) == null && rowData.pendukungcoblos_tps == null || rowData.pendukungcoblos_tps == 'default.png') {
                spanVerification = `
        <span class="badge bg-warning">Belum Upload Bukti</span>
    `;
            }

            if (String(rowData.verificationcoblos_tps) == '0') {
                spanVerification = `
                <a class="btn btn-danger btn-sm me-1 btn-verify" data-id="${rowData.id}" data-verificationcoblos_tps="1" title="Verifikasi">
                    <i class="fas fa-check"></i>
                </a> <br>
                <span class="badge bg-danger">Pengajuan Ditolak</span>
    `;
            }
            if (String(rowData.verificationcoblos_tps) == '1') {
                spanVerification = `
                <span class="badge bg-success me-1">Berhasil diverifikasi</span>
                <a class="btn btn-danger btn-sm btn-verify" data-id="${rowData.id}" data-verificationcoblos_tps="0" title="Batalkan Verifikasi">
                    <i class="fas fa-times"></i>
                </a>
               
    `;
            }

            // users koordinator
            let setKoordinator = getUsersKoordinator(rowData.users_id_koordinator);
            let outputKoordinator = setKoordinator;
            if (setKoordinator != null) {
                outputKoordinator = setKoordinator.profile.nama_profile + ' / ' + setKoordinator.profile.nohp_profile;
            }

            if (setKoordinator == null) {
                outputKoordinator = 'Belum ada';
            }


            // upload bukti pencoblosan
            let linkGambarCoblos =
                `${root}upload/coblos/${rowData.tps_coblos}`;

            let tps_coblos = `
                    <a class="photoviewer" href="${linkGambarCoblos}" data-gallery="photoviewer" data-title="${rowData.tps_coblos}">
                        <img class="img-thumbnail" width="100px;" src="${linkGambarCoblos}"></img>    
                    </a>
                    `;
            if (rowData.tps_coblos == 'default.png' || rowData.tps_coblos == null) {
                let linkGambarCoblos =
                    `${root}upload/coblos/default.png`;
                tps_coblos = `
                    <a class="photoviewer" href="${linkGambarCoblos}" data-gallery="photoviewer" data-title="default.png">
                        <img class="img-thumbnail" width="100px;" src="${linkGambarCoblos}"></img>    
                    </a>
                    `;
            }


            let tps_status = null;
            if (rowData.tps_status == 1 && rowData.verificationcoblos_tps == 1) {
                tps_status = `
                    <span class="badge bg-success me-2">Sudah Mencoblos</span>  
                    
                    <a class="btn btn-danger btn-sm btn-cancel-coblos" data-id="${rowData.id}" title="Batalkan Pencoblosan">
                    <i class="fas fa-times"></i>
                </a>
                `;
            }

            if (rowData.tps_status == 0 && rowData.verificationcoblos_tps != 1) {
                tps_status = `
                    <span class="badge bg-warning">Belum Diverifikasi</span>
                `;
            }

            if (rowData.tps_status == 0 && rowData.verificationcoblos_tps == 1) {
                tps_status = `
                    <span class="badge bg-warning me-2">Belum Mencoblos</span>
                `;
            }



            return `
            <div class="row">
                     <div class="col-lg-6">
                         <h5>Users Acount</h5>
                         <hr>
                         <table class="w-100">
                             <tr>
                                 <td>Username</td>
                                 <td>:</td>
                                 <td><span id="username">${rowData.users.username}</span></td>
                             </tr>
                             <tr>
                                 <td>Status Aktif</td>
                                 <td>:</td>
                                 <td><span id="is_aktif">
                                       ${rowData.users.is_aktif == 1 ? `<i class="fas fa-check text-success"></i>` : `
                                        <i class="fas fa-times text-danger"></i>` }  
                                     </span>
                                     </td>
                             </tr>
                             <tr>
                                 <td>Status Pendaftaran TPS</td>
                                 <td>:</td>
                                 <td><span id="is_registps">
                                 ${rowData.users.is_registps == 1 ? `<i class="fas fa-check text-success"></i>` : `
                                        <i class="fas fa-times text-danger"></i>` }  
                                     </span></td>
                             </tr>
                         </table>

                         <div style="height: 25px;"></div>
                        <h5>Verifikasi Bukti Pendukung</h5>
                        <hr>
                        <table class="w-100">
                        <tr>
                                <td>Koordinator</td>
                                <td>:</td>
                                <td><span id="users_id_koordinator">
                                ${outputKoordinator}
                                    </span>
                            </td>
                            </tr>
                            <tr>
                                <td>Bukti Upload</td>
                                <td>:</td>
                                <td><span id="pendukungcoblos_tps">${pendukungcoblos_tps}</span></td>
                            </tr>
                            <tr>
                                <td>Status Verifikasi</td>
                                <td>:</td>
                                <td><span id="verificationcoblos_tps">${spanVerification}</span></td>
                            </tr>
                        </table>

                        <div style="height: 25px;"></div>
                        <h5>Verifikasi Pencoblosan</h5>
                        <hr>
                        <table class="w-100">
                            <tr>
                                <td>Bukti Pencoblosan</td>
                                <td>:</td>
                                <td><span id="tps_coblos">${tps_coblos}</span></td>
                            </tr>
                            <tr>
                                <td>Status Pencoblosan</td>
                                <td>:</td>
                                <td><span id="tps_status">${tps_status}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h5>Biodata Pendukung</h5>
                            <hr>
                            <table class="w-100">
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td><span id="nik_profile">${rowData.users.profile.nik_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><span id="nama_profile">${rowData.users.profile.nama_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><span id="email_profile">${rowData.users.profile.email_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><span id="alamat_profile">${rowData.users.profile.alamat_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td><span id="nohp_profile">${rowData.users.profile.nohp_profile}</span></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><span id="jenis_kelamin_profile">
                                    ${rowData.users.profile.jenis_kelamin_profile == 'L' ? 'Laki-laki' : 'Perempuan'}
                                    </span></td>
                                </tr>
                                <tr>
                                    <td>Gambar profile</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span id="gambar_profile">
                                            ${gambar_profile}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }



        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            $('.form-submit input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit').attr('action', url + '/admin/pendukung');

            tablePendukung.ajax.reload();
            resetForm();

            $('#form-table').removeClass('d-none');
            $('#form-edit').addClass('d-none');
        })


        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'></div>" +
                "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.text);
            return $container;
        }

        function formatRepoSelection(repo) {
            return repo.text;
        }


        function setUsersId(setData = {}) {
            var users_id = $('.users_id_select').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ url('/admin/pendukung/selectPendukung') }}`,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            ...setData
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: (params.page * 10) < data.count_filtered
                            }
                        };
                    },
                    cache: true,
                },
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            return users_id;
        }

        function getUsersKoordinator(users_id) {
            let setUrl = "{{ url('/') }}";
            var output = null;
            $.ajax({
                url: `${setUrl}/admin/users/${users_id}/edit`,
                method: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    const {
                        result
                    } = data;
                    output = result;
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
            return output;
        }


        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            $('#form-table').addClass('d-none');
            $('#form-edit').removeClass('d-none');

            tablePendukung.ajax.reload();
            const id = $(this).data('id');
            const action = $(this).attr('href');
            const root = "{{ asset('/') }}";
            $.ajax({
                url: action,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        result
                    } = data;

                    setUsersId({
                        users_id: result.users.id
                    });


                    $('.users_id_select').append(
                            new Option(result.users.profile.nik_profile +
                                ' ' + result.users.profile.nama_profile, result.users.id, true, true)
                        )
                        .trigger("change");
                    $('.form-submit input[name="_method"]').val('put');
                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + '/admin/pendukung/' + result.id);
                    $('#modalForm').modal('show');
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");
            $('.users_id_select option').attr('selected', false).trigger('change');

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            $('.form-submit').submit();
        })

        $(document).on('submit', '.form-submit', function(e) {
            e.preventDefault();
            var form = $('.form-submit')[0];
            var data = new FormData(form);
            var action = $('.form-submit').attr('action');
            onSubmit(action, data);
        })

        function onSubmit(action, data) {
            $.ajax({
                url: action,
                type: "POST",
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.btn-submit').attr('disabled', true);
                },
                success: function(data) {
                    if (data.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalForm').modal('hide');
                        table.ajax.reload();

                        const {
                            result
                        } = data;
                        resetForm(result);
                    }

                    if (data.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalForm').modal('hide');
                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    const {
                        responseJSON,
                        responseText
                    } = xhr;
                    if (responseText != null) {
                        console.log(responseText);
                    }

                    if (responseJSON.result != undefined) {
                        let outputResult = responseJSON.result;
                        $.each(outputResult, function(v, i) {
                            let textError = outputResult[v][0];
                            let keyError = v;
                            $('.' + keyError).addClass("border border-danger");
                            $('.error_' + keyError).html(textError);
                        })
                    }
                },
                complete: function() {
                    $('.btn-submit').attr('disabled', false);
                }
            });
        }

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const action = $(this).closest("form").attr('action');
            Swal.fire({
                title: 'Deleted',
                text: "Yakin ingin menghapus item ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        dataType: 'json',
                        type: 'post',
                        method: 'DELETE',
                        success: function(data) {
                            if (data.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                );
                                table.ajax.reload();

                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'error'
                                )
                            }

                        },
                        error: function(x, t, m) {
                            console.log(x.responseText);
                        }
                    })
                }
            })
        })

        // initialize manually with a list of links
        $(document).on('click', '[data-gallery="photoviewer"]', function(e) {
            e.preventDefault();
            var items = [],
                options = {
                    index: $('.photoviewer').index(this),
                };

            $('[data-gallery="photoviewer"]').each(function() {
                items.push({
                    src: $(this).attr('href'),
                    title: $(this).attr('data-title')
                });
            });

            new PhotoViewer(items, options);
        });

        function saveSessionCheck(setData = {}) {
            let url = "{{ url('/') }}";
            $.ajax({
                url: `${url}/admin/pendukung/saveSession`,
                dataType: 'json',
                type: 'get',
                data: setData,
                success: function(data) {
                    console.log(data);
                }
            });
        }

        $(document).on('click', '.check-all', function(e) {
            if ($(this).is(':checked')) {
                $('.check-input').prop('checked', true);
            } else {
                $('.check-input').prop('checked', false);
            }

            let checkInput = $('.check-input');
            let pushValue = [];
            let pushAllValue = [];
            let pushNotChecked = [];

            $.each(checkInput, function(i, v) {
                if ($(this).is(":checked")) {
                    let value = $(this).val();
                    pushValue.push(value);
                } else {
                    let value = $(this).val();
                    pushNotChecked.push(value);
                }
                let value = $(this).val();
                pushAllValue.push(value);
            })

            let setData = {
                checked: pushValue,
                all_data: pushAllValue,
                not_checked: pushNotChecked
            }

            saveSessionCheck(setData);
        });

        $(document).on('click', '.check-input', function(e) {
            let checkedLength = $('.check-input:checked').length;
            let checkLength = $('.check-input').length;

            if (checkLength == checkedLength) {
                $('.check-all').prop('checked', true);
            } else {
                $('.check-all').prop('checked', false);
            }

            let checkInput = $('.check-input');
            let pushValue = [];
            let pushAllValue = [];
            let pushNotChecked = [];
            $.each(checkInput, function(i, v) {
                if ($(this).is(":checked")) {
                    let value = $(this).val();
                    pushValue.push(value);
                } else {
                    let value = $(this).val();
                    pushNotChecked.push(value);
                }
                let value = $(this).val();
                pushAllValue.push(value);
            })

            let setData = {
                checked: pushValue,
                all_data: pushAllValue,
                not_checked: pushNotChecked
            }

            saveSessionCheck(setData);
        });

        $(document).on('click', '.btn-verify', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let verificationcoblos_tps = $(this).data('verificationcoblos_tps');
            let setUrl = "{{ url('/') }}";


            Swal.fire({
                title: 'Info',
                text: "Apakah anda yaking ingin verifikasi data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${setUrl}/admin/pendukung/verify`,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id,
                            verificationcoblos_tps
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                table.ajax.reload();
                            })
                        }
                    })
                }
            })


        })

        $(document).on('click', '.btn-cancel-coblos', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let setUrl = "{{ url('/') }}";
            Swal.fire({
                title: 'Info',
                text: "Apakah anda yaking ingin membatalkan pencoblosan ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${setUrl}/admin/pendukung/coblos`,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            id,
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                table.ajax.reload();
                            })
                        }
                    })
                }
            })


        })
    })
</script>