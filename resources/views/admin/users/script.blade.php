<script>
    $(document).ready(function(e) {
        let owl = $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
            }
        })
        owl.owlCarousel();

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

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            resetForm();

            $('input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit').attr('action', url + '/admin/users');
            let roles = $(this).data('roles');


            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles == roles);
            if (checkRoles != null) {
                if (roles == 'pendukung') {
                    $('#div_account').addClass('d-none');
                    owl.trigger('to.owl.carousel', 1);
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


            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles == roles);
            if (checkRoles != null) {
                if (roles == 'pendukung') {
                    $('#div_account').addClass('d-none');
                    owl.trigger('to.owl.carousel', 1);
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

                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + '/admin/users/' + result.id);
                    $('#modalForm').modal('show');
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })



        function resetForm(attribute = null) {
            $('.jabatan_id option').attr('selected', false).trigger('change');
            $('.form-submit').trigger("reset");

            $('#div_account').removeClass('d-none');
            owl.trigger('to.owl.carousel', 0);
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


            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles == roles);
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



        // Go to the next item
        $('.customNextBtn').click(function() {
            owl.trigger('next.owl.carousel');
        })

        // Go to the previous item
        $('.customPrevBtn').click(function() {
            owl.trigger('prev.owl.carousel', [300]);
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
    })
</script>