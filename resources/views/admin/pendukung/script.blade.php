<script>
    $(document).ready(function(e) {
        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modalForm')
        });
        var table = $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('admin.pendukung.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            $('input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit').attr('action', url + '/admin/pendukung');
            $('.detail-tps').data('mode_form', 'add');

            resetForm();
        })

        let owl = $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
            }
        })

        function resetTps() {
            $('#modalForm span#kuota_tps').html('');
            $('#modalForm input.tps_id').val('');
            $('#modalForm span#users_id').html('');
            $('#modalForm span#provinces_id').html('');
            $('#modalForm span#districts_id').html('');
            $('#modalForm span#regencies_id').html('');
            $('#modalForm span#villages_id').html('');
            $('#modalForm span#alamat_tps').html('');
        }

        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");
            $('.form-submit-upload').trigger("reset");
            $('#load-bukticoblos_detail').html('');
            $('#load_gambar_profile').html('');

            $('.jenis_kelamin_profile').attr('checked', false);
            owl.trigger('to.owl.carousel', 0)

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }

            resetTps();
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
                    console.log("get data", data);
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
                        getTps();

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
                                getTps();
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



        owl.owlCarousel();
        // Go to the next item
        $('.customNextBtn').click(function() {
            owl.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.customPrevBtn').click(function() {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
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


        function getTps() {
            let url = "{{ url('/') }}";
            let tps_id = "{{ $tps_id }}";
            $.ajax({
                url: `${url}/admin/tps/${tps_id}/edit`,
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    if (data.status == 200) {
                        const {
                            result
                        } = data;
                        $('#totallk_tps').text(result.totallk_tps);
                        $('#totalpr_tps').text(result.totalpr_tps);
                        $('#totalsemua_tps').text(result.totalsemua_tps);
                    }
                }
            })
        }

        $(document).on('click', '.btn-upload-bukti', function() {
            let id = $(this).data('id');
            let url = "{{ url('/') }}";
            let setUrl = `${url}/admin/pendukung/${id}/uploadBuktiCoblos`;
            let bukticoblos_detail = $(this).data('bukticoblos_detail');

            let setGambar = bukticoblos_detail;
            if (bukticoblos_detail == '') {
                setGambar = 'default.png';
            }

            let assetUrl = "{{ asset('/') }}";
            let uploadGambarUrl = `${assetUrl}upload/tps/${setGambar}`;

            $('#load-bukticoblos_detail').html(
                `<a class="photoviewer" href="${uploadGambarUrl}" data-gallery="photoviewer" data-title="${setGambar}" class="d-block">
                        <img src="${uploadGambarUrl}" width="100%;"></img>
                    </a>`
            );
            $('.form-submit-upload').attr('action', setUrl);
            $('#modalUpload').modal('show');

        })

        $(document).on('click', '.btn-submit-upload', function(e) {
            e.preventDefault();
            $('.form-submit-upload').submit();
        })

        $(document).on('submit', '.form-submit-upload', function(e) {
            e.preventDefault();
            var form = $('.form-submit-upload')[0];
            var data = new FormData(form);
            var action = $('.form-submit-upload').attr('action');
            onSubmitUpload(action, data);
        })

        function onSubmitUpload(action, data) {
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
                    $('.btn-submit-upload').attr('disabled', true);
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

                        $('#modalUpload').modal('hide');
                        table.ajax.reload();

                        const {
                            result
                        } = data;
                        resetForm(result);
                        getTps();
                    }

                    if (data.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalUpload').modal('hide');
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
                    $('.btn-submit-upload').attr('disabled', false);
                }
            });
        }

        $(document).on('click', '.btn-verification', function(e) {
            e.preventDefault();
            let action = $(this).attr('href');
            let detail_verification = $(this).data('detail_verification');

            Swal.fire({
                title: 'Verification',
                text: "Apakah anda yakin ingin konfirmasi verifikasi data ini ?",
                icon: 'info',
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
                        data: {
                            detail_verification: detail_verification
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.ajax.reload();
                        },
                        error: function(x, t, m) {
                            console.log(x.responseText);
                        }
                    })
                }
            })

        })
    })
</script>