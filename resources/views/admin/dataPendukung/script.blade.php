<script>
    $(document).ready(function(e) {
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

        loadHeaderTps();

        function loadHeaderTps() {
            let setUrl = "{{ url('/') }}";

            $.ajax({
                url: `${setUrl}/admin/dataPendukung/getHeaderTps`,
                type: 'get',
                dataType: 'json',
                data: {
                    tps_id: "{{ $tps_id }}"
                },
                success: function(data) {
                    $('#header_nama_tps').html(data.tps.nama_tps);
                    $('#header_alamat_tps').html(data.tps.alamat_tps);
                    $('#header_kelurahan_tps').html(data.tps.villages.name);

                    $('#header_pendukung_tps').html(data.tps.pendukung_tps);
                    $('#header_status_pendukung_tps').html(data.status_pencapaian);
                    $('#header_detail_pendukung_tps').html(data.detail_status);
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        }

        function loadGetUserTps(setData = {}) {
            let setUrl = "{{ url('/') }}";

            $.ajax({
                url: `${setUrl}/admin/dataPendukung/getUserTps`,
                type: 'get',
                dataType: 'json',
                data: {
                    ...setData
                },
                success: function(data) {

                    let setUrl = "{{ url('/') }}";

                    var button = ``;
                    if ((data.verificationcoblos_tps) == null && data.users_id_koordinator == null) {
                        button += `
                        <a href="${setUrl}/admin/dataPendukung/${data.id}/uploadBukti" class="btn btn-outline-info m-b-xs btn-upload" style="border-color: #279EFF !important;" title="upload bukti pendukung">
                        <i class="fas fa-image"></i>
                        </a>
                        `;
                    }

                    if ((data.verificationcoblos_tps) == null && data.users_id_koordinator != null) {
                        button += `
                        <span class="badge bg-info">
                            <i class="fas fa-clock"></i> Menunggu verifikasi
                        </span>
                        `;
                    }


                    if (String(data.verificationcoblos_tps) == '1') {
                        let userProfile = getUsersKoordinator(data.users_id_koordinator);

                        button += `
                        <span class="badge bg-success">
                            <i class="fas fa-user-tie"></i> Ditangani oleh: ${userProfile.profile.nama_profile}
                        </span>
                        `;
                    }

                    if (String(data.verificationcoblos_tps) == '0') {
                        let userProfile = getUsersKoordinator(data.users_id_koordinator);

                        $buttonVerification = `
                        <a href="${setUrl}/admin/dataPendukung/${data.id}/uploadBukti" class="btn btn-outline-info m-b-xs btn-upload" style="border-color: #279EFF !important;" title="upload bukti pendukung">
                        <i class="fas fa-image"></i>
                        </a>
                        <br>

                        <span class="badge bg-danger">
                            <i class="fas fa-user-tie"></i> Ditolak pengajuan: ${userProfile.profile.nama_profile}
                        </span>
                        `;
                    }



                    var outputButton = `
                <div class="text-center">
                        ${button}
                </div>
                    `;

                    const {
                        users: {
                            profile
                        }
                    } = data;


                    $('#loadTableSearch').html(`
                    <tr>
                        <td>
                        ${profile.nama_profile}
                        </td>
                        <td>
                        ${profile.nik_profile}
                        </td>
                        <td>
                        ${profile.nohp_profile}
                        </td>
                        <td>
                        ${profile.email_profile == null ? '-' : profile.email_profile}
                        </td>
                        <td>
                        ${profile.alamat_profile}
                        </td>
                        <td>
                        ${outputButton}
                        </td>
                    </tr>
                    `);
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
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
                    url: "{{ route('admin.dataPendukung.index') }}",
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
                    {
                        data: "tps_status_view",
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

            const setUploadBukti = (label) => {
                let setUrl = "{{ url('/') }}";

                let uploadBukti = `
                <a href="${setUrl}/admin/dataPendukung/${rowData.id}/uploadBukti" class="btn btn-outline-info m-b-xs btn-upload" style="border-color: #279EFF !important;" title="${label}">
                        <i class="fas fa-upload"></i> <br>
                        <small>${label}</small>
                </a>
                `;
                return uploadBukti;
            }

            if ((rowData.verificationcoblos_tps) == null && rowData.pendukungcoblos_tps != null && rowData.pendukungcoblos_tps != 'default.png') {

                spanVerification = ` 
                <div>
                    <span class="badge bg-info me-2">Menunggu Verifikasi</span> 
                    ${setUploadBukti('Upload Ulang')}
                </div>
                `;
            }

            if ((rowData.verificationcoblos_tps) == null && rowData.pendukungcoblos_tps == null || rowData.pendukungcoblos_tps == 'default.png') {
                spanVerification = `
                    <span class="badge bg-warning me-2">Belum Upload Bukti</span>
                    ${setUploadBukti('Bukti Lapangan')}
                `;
            }

            if (String(rowData.verificationcoblos_tps) == '0') {
                spanVerification = `
                    <span class="badge bg-danger me-2">Verifikasi Ditolak</span>
                    ${setUploadBukti('Upload Ulang')}
                `;
            }
            if (String(rowData.verificationcoblos_tps) == '1') {
                spanVerification = `
                    <span class="badge bg-success me-2">Diverifikasi</span>
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
            const setUploadCoblos = (label) => {
                let setUrl = "{{ url('/') }}";

                let uploadCoblos = `
                <a href="${setUrl}/admin/dataPendukung/${rowData.id}/uploadCoblos" class="btn btn-outline-info m-b-xs btn-coblos" data-id="${rowData.id}" style="border-color: #279EFF !important;" title="${label}">
                        <i class="fas fa-upload"></i> <br>
                        <small>${label}</small>
                </a>
                `;
                return uploadCoblos;
            }
            if (rowData.tps_status == 1 && rowData.verificationcoblos_tps == 1) {
                tps_status = `
                    <span class="badge bg-success me-2">Sudah Mencoblos</span> ${setUploadCoblos('Upload Ulang')}
                `;
            }

            if (rowData.tps_status == 0 && rowData.verificationcoblos_tps != 1) {
                tps_status = `
                    <span class="badge bg-warning">Belum Diverifikasi</span>
                `;
            }

            if (rowData.tps_status == 0 && rowData.verificationcoblos_tps == 1) {
                tps_status = `
                    <span class="badge bg-warning me-2">Belum Mencoblos</span>  ${setUploadCoblos('Bukti Pencoblosan')}
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

                         <h5>Verifikasi Bukti Ke Lapangan</h5>
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
                                    <td><span id="email_profile">
                                    ${rowData.users.profile.email_profile == null ? '-' :  rowData.users.profile.email_profile}</span></td>
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
                    url: `{{ url('/admin/pendukung/selectPendukungTps') }}`,
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

        $('.users_id_select').on('select2:select', function(e) {
            let value = $(this).val();

            loadGetUserTps({
                id: value
            })
        });


        $(document).on('click', '.btn-upload', function(e) {
            e.preventDefault();

            setUsersId({
                tps_id: "{{ $tps_id }}"
            });
            $('#modalPencarian').modal('hide');

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

                    let gambar_bukti = result.pendukungcoblos_tps == null ? 'default.png' : result.pendukungcoblos_tps;

                    const root = "{{ asset('/') }}";
                    let linkGambar =
                        `${root}upload/tps/${gambar_bukti}`;
                    $('#load_pendukungcoblos_tps').html(`
                    <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${gambar_bukti}">
                        <img class="img-thumbnail" class="w-25" src="${linkGambar}" width="200px;"></img>    
                    </a>
                    `);

                    $('.form-submit input[name="_method"]').val('post');
                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + `/admin/dataPendukung/${result.id}/store`);
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

        $(document).on('click', '.btn-search-pendukung', function(e) {
            e.preventDefault();
            $('#modalPencarian').modal('show');
            $('#modalForm').modal('hide');


            $('#loadTableSearch').html(`
            <tr>
                <td colspan="6">
                    <div class="text-center">
                        <strong>
                            Belum pilih pendukung
                        </strong>
                    </div>
                </td>
            </tr>
            `);
            $('.users_id_select').find('option').remove();
            $('.users_id_select').append(
                    new Option('Pilih pendukung', '', true, true)
                )
                .trigger("change");

            let tpsId = "{{ $tps_id }}";
            setUsersId({
                tps_id: tpsId
            });
        })

        // pencoblosan
        function getPendukungTps(id) {
            let setUrl = "{{ url('/') }}";
            var output = null;

            $.ajax({
                url: `${setUrl}/admin/dataPendukung/${id}/uploadBukti`,
                method: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    const {
                        result
                    } = data
                    output = result;

                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })

            return output;
        }

        function resetFormCoblos(attribute = null) {
            $('.form-submit-coblos').trigger("reset");
            $('#load_tps_coblos').html('');

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.btn-coblos', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            let getData = getPendukungTps(id);


            let gambar_bukti = getData.tps_coblos == null ? 'default.png' : getData.tps_coblos;

            const root = "{{ asset('/') }}";
            let linkGambar =
                `${root}upload/coblos/${gambar_bukti}`;

            $('#load_tps_coblos').html(`
<a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${gambar_bukti}">
    <img class="img-thumbnail" class="w-25" src="${linkGambar}" width="200px;"></img>    
</a>
`);
            let action = $(this).attr('href');
            $('.form-submit-coblos').attr('action', action);

            $('#modalCoblos').modal('show');
        })


        $(document).on('click', '.btn-submit-coblos', function(e) {
            e.preventDefault();
            $('.form-submit-coblos').submit();
        })

        $(document).on('submit', '.form-submit-coblos', function(e) {
            e.preventDefault();
            var form = $('.form-submit-coblos')[0];
            var data = new FormData(form);
            var action = $('.form-submit-coblos').attr('action');
            onSubmitCoblos(action, data);
        })

        function onSubmitCoblos(action, data) {
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
                    $('.btn-submit-coblos').attr('disabled', true);
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

                        $('#modalCoblos').modal('hide');
                        table.ajax.reload();

                        const {
                            result
                        } = data;
                        resetFormCoblos(result);

                        loadHeaderTps();
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
                    $('.btn-submit-coblos').attr('disabled', false);
                }
            });
        }
    })
</script>