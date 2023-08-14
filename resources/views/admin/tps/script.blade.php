<script>
    $(document).ready(function(e) {
        var table = $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('admin.tps.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            $('.form-submit input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit').attr('action', url + '/admin/tps');

            resetForm();
        })

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
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


                    $('.provinces_id').append(
                            new Option(result.provinces.name, result.provinces.id, true, true)
                        )
                        .trigger("change");
                    $('.regencies_id').append(
                            new Option(result.regencies.name, result.regencies.id, true, true)
                        )
                        .trigger("change");
                    $('.districts_id').append(
                            new Option(result.districts.name, result.districts.id, true, true)
                        )
                        .trigger("change");
                    $('.villages_id').append(
                            new Option(result.villages.name, result.villages.id, true, true)
                        )
                        .trigger("change");
                    $('.nama_tps').val(result.nama_tps);
                    $('.alamat_tps').val(result.alamat_tps);
                    $('.minimal_tps').val(result.minimal_tps);
                    $('.pendukung_tps').val(result.pendukung_tps);
                    $('.kuota_tps').val(result.kuota_tps);
                    $('.form-submit input[name="_method"]').val('put');

                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + '/admin/tps/' + result.id);
                    $('#modalForm').modal('show');
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");
            $('.provinces_id option').attr('selected', false).trigger('change');
            $('.regencies_id option').attr('selected', false).trigger('change');
            $('.districts_id option').attr('selected', false).trigger('change');
            $('.villages_id option').attr('selected', false).trigger('change');

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        function resetFormKoordinator(attribute = null) {
            $('.form-submit-koordinator').trigger("reset");
            $('.users_id option').attr('selected', false).trigger('change');

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

        $(document).on('change', '.districts_id', function() {
            let value = $(this).val();
            getKelurahan(value);
        })

        function getKelurahan(district_id) {
            $('.villages_id').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ url('/admin/kelurahan') }}`,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            xhr: 'getKelurahan',
                            search: params.term,
                            page: params.page || 1,
                            district_id: district_id
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

        function getAddKoordinator(users_id) {
            let getUrl = "{{ url('/') }}";
            var output = null;
            $.ajax({
                url: `${getUrl}/admin/tps/${users_id}/getAddKoordinator`,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
                }
            })

            return output;
        }

        $(document).on('click', '.btn-add-koordinator', function(e) {
            e.preventDefault();
            $('.users_id option').remove();

            $('.form-submit-koordinator input[name="_method"]').val('post');

            let id = $(this).data('id');
            let url = "{{ url('/admin/tps/') }}";
            let setUrl = `${url}/${id}/addKoordinator`;

            var getKoordinator = getAddKoordinator(id);

            let pushOptions = [];
            getKoordinator.map((v, i) => {
                let setOption = new Option(v.nama_profile, v.users_id, true, true);
                pushOptions.push(setOption);
            })
            if (pushOptions.length > 0) {
                $('.users_id').append(pushOptions)
                    .trigger("change");
            }


            $('.form-submit-koordinator').attr('action', setUrl);
            $('#modalFormKoordinator').modal('show');

            $('.users_id').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: `{{ url('/admin/tps/getKoordinator') }}`,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
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
        })

        $(document).on('click', '.btn-submit-koordinator', function(e) {
            e.preventDefault();
            $('.form-submit-koordinator').submit();
        })

        $(document).on('submit', '.form-submit-koordinator', function(e) {
            e.preventDefault();
            var form = $('.form-submit-koordinator')[0];
            var data = new FormData(form);
            var action = $('.form-submit-koordinator').attr('action');
            onSubmitKoordinator(action, data);
        })

        function onSubmitKoordinator(action, data) {
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
                    $('.btn-submit-koordinator').attr('disabled', true);
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

                        $('#modalFormKoordinator').modal('hide');
                        table.ajax.reload();

                        const {
                            result
                        } = data;
                        resetFormKoordinator(result);
                    }

                    if (data.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalFormKoordinator').modal('hide');
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
                    $('.btn-submit-koordinator').attr('disabled', false);
                }
            });
        }

    })
</script>