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
                var output = getTpsDetail(tpsDetailId);

                const {
                    tps
                } = output;

                $('.provinces_id').append(
                    new Option(tps.provinces.name, tps.provinces.id, true, true));
                $('.regencies_id').append(
                    new Option(tps.regencies.name, tps.regencies.id, true, true));
                $('.districts_id').append(
                    new Option(tps.districts.name, tps.districts.id, true, true));
                $('.villages_id').append(
                    new Option(tps.villages.name, tps.villages.id, true, true));
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
            $('span#kuota_tps').html(data.kuota_tps);
            $('input.tps_id').val(data.id);
            $('span#provinces_id').html(data.provinces.name);
            $('span#districts_id').html(data.regencies.name);
            $('span#regencies_id').html(data.districts.name);
            $('span#villages_id').html(data.villages.name);
            $('span#alamat_tps').html(data.alamat_tps);

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
            $('span#kuota_tps').html('');
            $('input.tps_id').val('');
            $('span#users_id').html('');
            $('span#provinces_id').html('');
            $('span#districts_id').html('');
            $('span#regencies_id').html('');
            $('span#villages_id').html('');
            $('span#alamat_tps').html('');
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

                    const {
                        tps
                    } = result;

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


                    displayTps(tps);
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

            const {
                tps
            } = output;


            let assetUrl = "{{ asset('/') }}";
            let uploadGambarUrl = `${assetUrl}upload/profile/${profile.gambar_profile}`;



            $('span#nik_profile').html(profile.nik_profile);
            $('span#nama_profile').html(profile.nama_profile);
            $('span#jenis_kelamin_profile').html(profile.jenis_kelamin_profile);
            $('span#gambar_profile').html(
                `<a class="photoviewer" href="${uploadGambarUrl}" data-gallery="photoviewer" data-title="${profile.gambar_profile}" class="d-block">
                        <img src="${uploadGambarUrl}" height="200px"></img>
                    </a>`
            );

            $('span#email_profile').html(profile.email_profile);
            $('span#nohp_profile').html(profile.nohp_profile);


            $('span#nama_tps').html(tps.nama_tps);
            $('span#alamat_tps').html(tps.alamat_tps);
            $('span#provinces_id').html(tps.provinces.name);
            $('span#regencies_id').html(tps.regencies.name);
            $('span#districts_id').html(tps.districts.name);
            $('span#villages_id').html(tps.villages.name);
        })
    })
</script>