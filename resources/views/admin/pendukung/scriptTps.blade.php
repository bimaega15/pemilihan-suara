<script>
    $(document).ready(function() {
        let getFilterWilayah = defaultWilayah();

        function tableWilayah(getFilterWilayah = {}) {
            var table = $('#dataTableTps').DataTable({
                responsive: true,
                ajax: {
                    url: "{{ route('admin.pendukung.tpsPendukung') }}",
                    dataType: 'json',
                    type: 'get',
                    data: {
                        provinces_id: getFilterWilayah.provinces_id,
                        regencies_id: getFilterWilayah.regencies_id,
                        districts_id: getFilterWilayah.districts_id,
                        villages_id: getFilterWilayah.villages_id,
                    }
                },
            });
            return table;
        }

        var table = tableWilayah(getFilterWilayah);


        $(document).on('click', '.btn-search-wilayah', function(e) {
            e.preventDefault();
            $('#dataTableTps').DataTable().destroy();

            let getFilterWilayah = filterWilayah();
            tableWilayah(getFilterWilayah);
        })

        $(document).on('click', '.btn-reset-wilayah', function(e) {
            e.preventDefault();
            filterReset();

            $('#dataTableTps').DataTable().destroy();
            let getFilterWilayah = filterWilayah();
            tableWilayah(getFilterWilayah);
        })

        function filterReset() {
            $('.provinces_id option').remove();
            $('.regencies_id option').remove();
            $('.districts_id option').remove();
            $('.villages_id option').remove();
        }

        function defaultWilayah() {
            let provinces_id = "{{ $tps->provinces_id }}";
            let provinces_name = "{{ $tps->provinces->name }}";
            let regencies_id = "{{ $tps->regencies_id }}";
            let regencies_name = "{{ $tps->regencies->name }}";
            let districts_id = "{{ $tps->districts_id }}";
            let districts_name = "{{ $tps->districts->name }}";
            let villages_id = "{{ $tps->villages_id }}";
            let villages_name = "{{ $tps->villages->name }}";

            return {
                provinces_id,
                provinces_name,
                regencies_id,
                regencies_name,
                districts_id,
                districts_name,
                villages_id,
                villages_name
            }
        }

        function filterWilayah() {
            let provinces_id = $('.provinces_id').val();
            let regencies_id = $('.regencies_id').val();
            let districts_id = $('.districts_id').val();
            let villages_id = $('.villages_id').val();

            return {
                provinces_id,
                regencies_id,
                districts_id,
                villages_id,
            }
        }

        $(document).on('click', '.detail-tps', function(e) {
            e.preventDefault();
            $('#modalFormTps').modal('show');

            let modeForm = $(this).data('mode_form');
            if (modeForm == 'add') {
                let getFilterWilayah = defaultWilayah();
                $('.provinces_id').append(
                    new Option(getFilterWilayah.provinces_name, getFilterWilayah.provinces_id, true, true));
                $('.regencies_id').append(
                    new Option(getFilterWilayah.regencies_name, getFilterWilayah.regencies_id, true, true));
                $('.districts_id').append(
                    new Option(getFilterWilayah.districts_name, getFilterWilayah.districts_id, true, true));
                $('.villages_id').append(
                    new Option(getFilterWilayah.villages_name, getFilterWilayah.villages_id, true, true));
            }

            if (modeForm == 'edit') {
                let tpsDetailId = $(this).data('tps_detail_id');
                let btnDetail = $('.btn-detail[data-id="' + tpsDetailId + '"]')
                let tps_detail_id = btnDetail.data('tps_detail_id');
                let users_id = btnDetail.data('users_id');
                let tps_id = btnDetail.data('tps_id');
                let users_id_koordinator = btnDetail.data('users_id_koordinator');

                let setData = {};
                setData.tps_detail_id = tps_detail_id;
                setData.users_id = users_id;
                setData.tps_id = tps_id;
                setData.users_id_koordinator = users_id_koordinator;

                var outputData = getTpsPendukung(setData);
                $('.provinces_id').append(
                    new Option(outputData.provinces_name, outputData.provinces_id, true, true));
                $('.regencies_id').append(
                    new Option(outputData.regencies_name, outputData.regencies_id, true, true));
                $('.districts_id').append(
                    new Option(outputData.districts_name, outputData.districts_id, true, true));
                $('.villages_id').append(
                    new Option(outputData.villages_name, outputData.villages_id, true, true));

            }

            $('#dataTableTps').DataTable().destroy();

            let getFilterWilayah = filterWilayah();
            tableWilayah(getFilterWilayah);

        })

        function getTpsDetail(id) {
            var output = null;
            const url = "{{ url('/') }}";
            const action = `${url}/admin/pendukung/${id}/edit`;
            $.ajax({
                url: action,
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

        function displayTps(data) {
            if (data.provinces != null) {
                $('#modalForm span#kuota_tps').html(data.kuota_tps);
                $('#modalForm input.tps_id').val(data.id);
                $('#modalForm span#provinces_id').html(data.provinces.name);
                $('#modalForm span#districts_id').html(data.regencies.name);
                $('#modalForm span#regencies_id').html(data.districts.name);
                $('#modalForm span#villages_id').html(data.villages.name);
                $('#modalForm span#alamat_tps').html(data.alamat_tps);
            } else {
                $('#modalForm span#kuota_tps').html(data.kuota_tps);
                $('#modalForm input.tps_id').val(data.tps_id);
                $('#modalForm span#provinces_id').html(data.provinces_name);
                $('#modalForm span#districts_id').html(data.regencies_name);
                $('#modalForm span#regencies_id').html(data.districts_name);
                $('#modalForm span#villages_id').html(data.villages_name);
                $('#modalForm span#alamat_tps').html(data.alamat_tps);
            }


            $('#modalFormTps').modal('hide');
            $('#outputNoData').addClass('d-none');
            $('#outputTps').removeClass('d-none');
        }

        $(document).on('click', '.btn-choose-tps', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/pendukung/${id}/getTps`,
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    displayTps(data);
                }
            })
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

        $(document).on('click', '.btn-cancel-tps', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Batal TPS',
                text: "Anda yakin ingin membatalkan TPS ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#outputNoData').removeClass('d-none');
                    $('#outputTps').addClass('d-none');

                    resetTps();
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

                    $('.id').val(result.id);
                    $('.detail-tps').data('mode_form', 'edit');
                    $('.detail-tps').data('tps_detail_id', result.id);


                    $('.nik_profile').val(result.users.profile.nik_profile);
                    $('.nama_profile').val(result.users.profile.nama_profile);
                    $('.email_profile').val(result.users.profile.email_profile);
                    $('.nohp_profile').val(result.users.profile.nohp_profile);
                    $('.jenis_kelamin_profile[value="' + result.users.profile.jenis_kelamin_profile + '"]')
                        .attr('checked', true);

                    $('.alamat_profile').val(result.users.profile.alamat_profile);
                    let linkGambar =
                        `${root}upload/profile/${result.users.profile.gambar_profile}`;
                    $('#load_gambar_profile').html(`
                    <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${result.users.profile.gambar_profile}">
                        <img class="img-thumbnail" class="w-25" src="${linkGambar}"></img>    
                    </a>
                    `);
                    $('input[name="_method"]').val('put');

                    let url = "{{ url('/') }}";
                    $('.form-submit').attr('action', url + '/admin/pendukung/' + result.id);
                    $('#modalForm').modal('show');

                    let btnDetail = $('.btn-detail[data-id="' + result.id + '"]')
                    let tps_detail_id = btnDetail.data('tps_detail_id');
                    let users_id = btnDetail.data('users_id');
                    let tps_id = btnDetail.data('tps_id');
                    let users_id_koordinator = btnDetail.data('users_id_koordinator');

                    let setData = {};
                    setData.tps_detail_id = tps_detail_id;
                    setData.users_id = users_id;
                    setData.users_id_koordinator = users_id_koordinator;

                    var outputData = getTpsPendukung(setData);
                    displayTps(outputData);
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        $(document).on('click', '.btn-detail', function(e) {
            e.preventDefault();

            let tpsDetailId = $(this).data('id');
            var output = getTpsDetail(tpsDetailId);

            $('#modalDetail').modal('show');

            const {
                profile
            } = output.users;

            let assetUrl = "{{ asset('/') }}";
            let uploadGambarUrl = `${assetUrl}upload/profile/${profile.gambar_profile}`;

            $('#modalDetail span#nik_profile').html(profile.nik_profile);
            $('#modalDetail span#nama_profile').html(profile.nama_profile);
            $('#modalDetail span#jenis_kelamin_profile').html(profile.jenis_kelamin_profile);
            $('#modalDetail span#gambar_profile').html(
                `<a class="photoviewer" href="${uploadGambarUrl}" data-gallery="photoviewer" data-title="${profile.gambar_profile}" class="d-block">
                        <img src="${uploadGambarUrl}" height="200px"></img>
                    </a>`
            );

            $('#modalDetail span#email_profile').html(profile.email_profile);
            $('#modalDetail span#nohp_profile').html(profile.nohp_profile);


            // alamat tps pendukung
            let tps_detail_id = $(this).data('tps_detail_id');
            let users_id = $(this).data('users_id');
            let tps_id = $(this).data('tps_id');
            let users_id_koordinator = $(this).data('users_id_koordinator');

            let setData = {};
            setData.tps_detail_id = tps_detail_id;
            setData.users_id = users_id;
            setData.tps_id = tps_id;
            setData.users_id_koordinator = users_id_koordinator;

            var outputData = getTpsPendukung(setData);
            $('#modalDetail span#nama_tps').html(outputData.nama_tps);
            $('#modalDetail span#alamat_tps').html(outputData.alamat_tps);
            $('#modalDetail span#provinces_id').html(outputData.provinces_name);
            $('#modalDetail span#regencies_id').html(outputData.regencies_name);
            $('#modalDetail span#districts_id').html(outputData.districts_name);
            $('#modalDetail span#villages_id').html(outputData.villages_name);

        })

        function getTpsPendukung(setData = {}) {
            var output = null;
            const url = "{{ url('/') }}";
            const action = `${url}/admin/pendukung/getTpsPendukung`;
            $.ajax({
                url: action,
                method: 'get',
                dataType: 'json',
                async: false,
                data: {
                    ...setData
                },
                success: function(data) {
                    output = data;
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })

            return output;
        }
    })
</script>