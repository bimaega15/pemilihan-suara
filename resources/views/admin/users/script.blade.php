<script>
    $(document).ready(function(e) {

        function loadDynamic() {
            let setUrl = "{{ url('/') }}";
            var output = null;
            $.ajax({
                url: `${setUrl}/admin/users/getRoles`,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
                }
            })
            return output;
        }
        let getDynamic = loadDynamic();

        for (let i = 0; i < getDynamic.role.length; i++) {
            const element = getDynamic.role[i];
            let nameRoles = element.nama_roles.split(' ').join('-');
            nameRoles = nameRoles.toLowerCase();

            $(`#table-${nameRoles}`).DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                search: {
                    caseInsensitive: true,
                },
                searchHighlight: true,
                ajax: {
                    url: "{{ route('admin.users.index') }}",
                    dataType: 'json',
                    type: 'get',
                    data: {
                        roles: nameRoles
                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                    },
                    {
                        data: "username",
                        name: "username",
                        searchable: true
                    },
                    {
                        data: "nama_profile",
                        name: "nama_profile",
                        searchable: false
                    },
                    {
                        data: "email_profile",
                        name: "email_profile",
                        searchable: false
                    },
                    {
                        data: "nohp_profile",
                        name: "nohp_profile",
                        searchable: false,
                    },
                    {
                        data: "gambar_profile",
                        name: "gambar_profile",
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: "is_aktif",
                        name: "is_aktif",
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: "action",
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(settings) {
                    var info = $(`#table-${nameRoles}`).DataTable().page.info();
                    $(`#table-${nameRoles}`).DataTable()
                        .column(0, {
                            search: "applied",
                            order: "applied"
                        })
                        .nodes()
                        .each(function(cell, i) {
                            console.log()
                            cell.innerHTML = info.start + i + 1;
                        });
                },
            });
        }


        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modalForm')
        });

        function setActiveTab(roles) {
            if (roles == 'admin') {
                $('#pills-wilayah-tab').removeClass('active');
                $('#pills-account-tab').addClass('active');
                $('#pills-biodata-tab').removeClass('active');

                $('#pills-account').addClass('show active');
                $('#pills-wilayah').removeClass('show active');
                $('#pills-biodata').removeClass('show active');
            }
            if (roles == 'koordinator') {
                $('#pills-wilayah-tab').removeClass('active');
                $('#pills-account-tab').addClass('active');
                $('#pills-biodata-tab').removeClass('active');

                $('#pills-account').addClass('show active');
                $('#pills-wilayah').removeClass('show active');
                $('#pills-biodata').removeClass('show active');
            }
            if (roles == 'caleg') {
                $('#pills-wilayah-tab').removeClass('active');
                $('#pills-account-tab').addClass('active');
                $('#pills-biodata-tab').removeClass('active');

                $('#pills-account').addClass('show active');
                $('#pills-wilayah').removeClass('show active');
                $('#pills-biodata').removeClass('show active');
            }
            if (roles == 'pendukung') {

                $('#pills-wilayah-tab').removeClass('active');
                $('#pills-account-tab').removeClass('active');
                $('#pills-biodata-tab').addClass('active');

                $('#pills-account').removeClass('show active');
                $('#pills-wilayah').removeClass('show active');
                $('#pills-biodata').addClass('show active');
            }
            if (roles == 'koordinator kecamatan') {
                $('#pills-wilayah-tab').removeClass('active');
                $('#pills-account-tab').addClass('active');
                $('#pills-biodata-tab').removeClass('active');

                $('#pills-account').addClass('show active');
                $('#pills-wilayah').removeClass('show active');
                $('#pills-biodata').removeClass('show active');
            }
        }

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            resetForm();
            resetActiveButton();

            $('input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit').attr('action', url + '/admin/users');
            let roles = $(this).data('roles');
            roles = roles.split('-').join(' ');
            roles = roles.toLowerCase();

            setActiveTab(roles);
            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles.toLowerCase() == roles);
            if (checkRoles != null) {
                if (roles != 'koordinator kecamatan') {
                    $('#div_wilayah').addClass('d-none');
                    $('#pills-wilayah-tab').closest('li').addClass('d-none');
                    $('.role_id').val(checkRoles.id);
                }

                if (roles == 'pendukung') {
                    $('#pills-account-tab').closest('li').addClass('d-none');
                    $('#div_account').addClass('d-none');
                    $('.customPrevBtn').addClass('d-none');
                    $('.role_id').val(checkRoles.id);
                    $('.label-image-photo').html('Upload KTP');
                } else {
                    $('.role_id').val(checkRoles.id);
                }

            }

        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            $('.label-image-photo').html('Upload Photo');

            const id = $(this).data('id');
            const action = $(this).attr('href');
            const root = "{{ asset('/') }}";
            let roles = $(this).data('roles');
            roles = roles.split('-').join(' ');
            roles = roles.toLowerCase();
            setActiveTab(roles);

            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles.toLowerCase() == roles);
            if (checkRoles != null) {
                if (roles != 'koordinator kecamatan') {
                    $('#pills-wilayah-tab').closest('li').addClass('d-none');
                    $('#div_wilayah').addClass('d-none');
                    $('.role_id').val(checkRoles.id);
                }

                if (roles == 'pendukung') {
                    $('#pills-account-tab').closest('li').addClass('d-none');
                    $('#div_account').addClass('d-none');
                    $('.customPrevBtn').addClass('d-none');

                    $('.role_id').val(checkRoles.id);

                    $('.label-image-photo').html('Upload KTP');
                } else {
                    $('.role_id').val(checkRoles.id);
                }
            }

            $.ajax({
                url: action,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        result
                    } = data;

                    $('.id').val(result.id);
                    $('.password_old').val(result.password);
                    $('.username').val(result.username);
                    $('.role_id').val(result.roles[0].id);

                    $('.nik_profile').val(result.profile.nik_profile);
                    $('.jabatan_id').val(result.profile.jabatan_id).trigger('change');
                    $('.nama_profile').val(result.profile.nama_profile);
                    $('.email_profile').val(result.profile.email_profile);
                    $('.nohp_profile').val(result.profile.nohp_profile);
                    $('.jenis_kelamin_profile[value="' + result
                            .profile.jenis_kelamin_profile + '"]')
                        .attr('checked', true);

                    $('.alamat_profile').val(result.profile.alamat_profile);
                    let linkGambar =
                        `${root}upload/profile/${result.profile.gambar_profile}`;
                    $('#load_gambar_profile').html(`
                    <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${result.profile.gambar_profile}">
                        <img class="img-thumbnail" class="w-25" src="${linkGambar}"></img>    
                    </a>
                    `);
                    $('input[name="_method"]').val('put');
                    if (result.is_aktif == 1) {
                        $('input[name="is_aktif"]').attr('checked', true);
                    }

                    let checkRoles = getDynamic.role.find((v, i) => v.nama_roles.toLowerCase() == roles);
                    if (checkRoles != null) {
                        if (roles == 'koordinator kecamatan') {
                            var setUrl = "{{ url('/') }}";

                            function getProvinsi(provinces_id) {
                                var output = null;
                                $.ajax({
                                    url: `${setUrl}/admin/provinsi/${provinces_id}/edit`,
                                    dataType: 'json',
                                    type: 'get',
                                    async: false,
                                    success: function(data) {
                                        output = data.result;
                                    }
                                })
                                return output;
                            }

                            function getKabupaten(regencies_id) {
                                var output = null;
                                $.ajax({
                                    url: `${setUrl}/admin/kabupaten/${regencies_id}/edit`,
                                    dataType: 'json',
                                    type: 'get',
                                    async: false,
                                    success: function(data) {
                                        output = data.result;
                                    }
                                })
                                return output;
                            }

                            function getKecamatan(districts_id) {
                                var output = null;
                                $.ajax({
                                    url: `${setUrl}/admin/kecamatan/${districts_id}/edit`,
                                    dataType: 'json',
                                    type: 'get',
                                    async: false,
                                    success: function(data) {
                                        output = data.result;
                                    }
                                })
                                return output;
                            }

                            var getDataProvinsi = getProvinsi(result.provinces_id);
                            if (getDataProvinsi != null) {
                                $('.provinces_id').append(
                                        new Option(getDataProvinsi.name, getDataProvinsi.id, true, true)
                                    )
                                    .trigger("change");
                            }
                            var getDataKabupaten = getKabupaten(result.regencies_id);
                            if (getDataKabupaten != null) {
                                $('.regencies_id').append(
                                        new Option(getDataKabupaten.name, getDataKabupaten.id, true, true)
                                    )
                                    .trigger("change");
                            }
                            var getDataKecamatan = getKecamatan(result.districts_id);
                            if (getDataKecamatan != null) {
                                $('.districts_id').append(
                                        new Option(getDataKecamatan.name, getDataKecamatan.id, true, true)
                                    )
                                    .trigger("change");
                            }
                        }
                    }

                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + '/admin/users/' + result.id);
                    $('#modalForm').modal('show');
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })

        })

        function resetActiveButton() {
            $('#pills-wilayah-tab').closest('li').removeClass('active');
            $('#pills-account-tab').closest('li').removeClass('active');
            $('#pills-biodata-tab').closest('li').removeClass('active');

            $('#pills-account').closest('li').removeClass('show active');
            $('#pills-wilayah').closest('li').removeClass('show active');
            $('#pills-biodata').closest('li').removeClass('show active');
        }

        function resetButtonArea() {
            $('#pills-wilayah-tab').closest('li').removeClass('d-none');
            $('#pills-account-tab').closest('li').removeClass('d-none');

            $('#div_account').removeClass('d-none');
            $('#div_wilayah').removeClass('d-none');
        }


        function resetForm(attribute = null) {
            $('.provinces_id').append(
                    new Option('Pilih Provinsi', '', true, true)
                )
                .trigger("change");
            $('.regencies_id').append(
                    new Option('Pilih Kabupaten', '', true, true)
                )
                .trigger("change");
            $('.districts_id').append(
                    new Option('Pilih Kecamatan', '', true, true)
                )
                .trigger("change");

            $('.jabatan_id option').attr('selected', false).trigger('change');
            $('.form-submit').trigger("reset");

            resetButtonArea();
            $('.customPrevBtn').removeClass('d-none');

            $('.label-image-photo').html('Upload Photo');
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

            let roles = $('.role_id').val();
            for (let i = 0; i < getDynamic.role.length; i++) {
                const element = getDynamic.role[i];
                let nameRoles = element.nama_roles;
                nameRoles = nameRoles.toLowerCase();

                let rolesId = element.id;
                if (rolesId == roles) {
                    var provinces_id = $('select[name="provinces_id"]').val();
                    var regencies_id = $('select[name="regencies_id"]').val();
                    var districts_id = $('select[name="districts_id"]').val();
                    if (provinces_id == '' || provinces_id == null) {
                        return Swal.fire({
                            icon: 'info',
                            title: 'Peringatan!',
                            text: 'Provinsi wajib diisi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (regencies_id == '' || regencies_id == null) {
                        return Swal.fire({
                            icon: 'info',
                            title: 'Peringatan!',
                            text: 'Kabupaten wajib diisi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if (districts_id == '' || districts_id == null) {
                        return Swal.fire({
                            icon: 'info',
                            title: 'Peringatan!',
                            text: 'Kecamatan wajib diisi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }

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
                        let roles = $('.role_id').val();
                        for (let i = 0; i < getDynamic.role.length; i++) {
                            const element = getDynamic.role[i];
                            let nameRoles = element.nama_roles.split(' ').join('-');
                            nameRoles = nameRoles.toLowerCase();

                            let rolesId = element.id;
                            if (rolesId == roles) {
                                $(`#table-${nameRoles}`).DataTable().ajax.reload();
                            }
                        }


                        const {
                            result
                        } = data;
                        resetForm(result);
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
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Perhatikan kembali form anda dengan benar',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
            let roles = $(this).data('roles');
            roles = roles.split('-').join(' ');
            roles = roles.toLowerCase();


            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles.toLowerCase() == roles);
            if (checkRoles != null) {
                $('.role_id').val(checkRoles.id);
            }

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

                                let roles = $(this).data('roles');
                                for (let i = 0; i < getDynamic.role.length; i++) {
                                    const element = getDynamic.role[i];
                                    let nameRoles = element.nama_roles.split(' ').join('-');
                                    nameRoles = nameRoles.toLowerCase();

                                    if (nameRoles == roles) {
                                        $(`#table-${nameRoles}`).DataTable().ajax.reload();
                                    }
                                }


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

        $(document).on('click', '.check-input', function() {
            let id = $(this).data('id');
            let url = "{{ url('/') }}";
            let roles = $(this).data('roles');
            let is_aktif = $(this).data('is_aktif');

            $.ajax({
                url: `${url}/admin/users/setAktif`,
                dataType: 'json',
                type: 'post',
                data: {
                    id: id,
                    roles: roles,
                    is_aktif: is_aktif,
                },
                success: function(data) {

                    for (let i = 0; i < getDynamic.role.length; i++) {
                        const element = getDynamic.role[i];
                        let nameRoles = element.nama_roles.split(' ').join('-');
                        nameRoles = nameRoles.toLowerCase();

                        if (nameRoles == roles) {
                            $(`#table-${nameRoles}`).DataTable().ajax.reload();
                        }
                    }
                }
            })
        })

        function resetFormImport(attribute = null) {
            $('.form-submit-import').trigger("reset");

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.btn-submit-import', function(e) {
            e.preventDefault();
            $('.form-submit-import').submit();
        })

        $(document).on('submit', '.form-submit-import', function(e) {
            e.preventDefault();
            var form = $('.form-submit-import')[0];
            var data = new FormData(form);
            var action = $('.form-submit-import').attr('action');
            onSubmitImport(action, data);
        })

        function onSubmitImport(action, data) {
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
                    $('.btn-submit-import').attr('disabled', true);
                    $('#process-load-image').removeClass('d-none');
                },
                success: function(data) {
                    if (data.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalImport').modal('hide');
                            tablependukung.ajax.reload();

                            const {
                                result
                            } = data;
                            resetFormImport(result);
                        })
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
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Perhatikan kembali form anda dengan benar',
                            showConfirmButton: false,
                            timer: 1500
                        })
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
                    $('.btn-submit-import').attr('disabled', false);
                    $('#process-load-image').addClass('d-none');
                }
            });
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

        $('.provinces_id').select2({
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ url('/admin/provinsi') }}`,
                dataType: 'json',
                data: function(params) {
                    return {
                        xhr: 'getProvinsi',
                        search: params.term,
                        page: params.page || 1
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


        $(document).on('change', '.provinces_id', function() {
            let value = $(this).val();
            getKabupaten(value);
        })

        function getKabupaten(provinces_id) {
            $('.regencies_id').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ url('/admin/kabupaten') }}`,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            xhr: 'getKabupaten',
                            search: params.term,
                            page: params.page || 1,
                            provinces_id: provinces_id
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
        }

        $(document).on('change', '.regencies_id', function() {
            let value = $(this).val();
            getKecamatan(value);
        })

        function getKecamatan(regency_id) {
            $('.districts_id').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ url('/admin/kecamatan') }}`,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            xhr: 'getKecamatan',
                            search: params.term,
                            page: params.page || 1,
                            regency_id: regency_id
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
        }
    })
</script>