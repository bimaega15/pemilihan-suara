<script>
    $(document).ready(function() {

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

        fetch_user_data_progres();

        function fetch_user_data_progres(page = 1, setData = {}) {
            let url = "{{ url('/') }}";

            $.ajax({
                url: `${url}/admin/monitoring/fetchProgres?page=` + page,
                data: setData,
                success: function(data) {
                    $('#output_progres').html(data);
                }
            });
        }

        $(document).on('click', '#output_progres .pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_user_data_progres(page);
        })


        function whereDataProgres() {
            let provinces_id = $('#filter_progres .provinces_id').val();
            let regencies_id = $('#filter_progres .regencies_id').val();
            let districts_id = $('#filter_progres .districts_id').val();
            let villages_id = $('#filter_progres .villages_id').val();

            return {
                provinces_id,
                regencies_id,
                districts_id,
                villages_id
            }
        }

        $('#filter_progres .provinces_id').select2({
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


        $(document).on('change', '#filter_progres .provinces_id', function() {
            let value = $(this).val();
            getKabupaten(value);
            let active = $('#output_progres ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataProgres();
            fetch_user_data_progres(active, getWhere);
        })

        function getKabupaten(provinces_id) {
            $('#filter_progres .regencies_id').select2({
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

        $(document).on('change', '#filter_progres .regencies_id', function() {
            let value = $(this).val();
            getKecamatan(value);
            let active = $('#output_progres ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataProgres();
            fetch_user_data_progres(active, getWhere);
        })

        function getKecamatan(regency_id) {
            $('#filter_progres .districts_id').select2({
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

        $(document).on('change', '#filter_progres .districts_id', function() {
            let value = $(this).val();
            getKelurahan(value);
            let active = $('#output_progres ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataProgres();
            fetch_user_data_progres(active, getWhere);
        })

        function getKelurahan(district_id) {
            $('#filter_progres .villages_id').select2({
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

        $(document).on('change', '#filter_progres .villages_id', function() {
            let value = $(this).val();
            let active = $('#output_progres ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataProgres();
            fetch_user_data_progres(active, getWhere);
        })

        function whereResetProgres() {
            return {
                provinces_id: '',
                regencies_id: '',
                districts_id: '',
                villages_id: ''
            }
        }
        $(document).on('click', '.btn-reset-progres', function(e) {
            e.preventDefault();
            let getWhere = whereResetProgres();
            let active = $('#output_progres ul.pagination li.page-item.active span.page-link').text();
            fetch_user_data_progres(active, getWhere);
        })


        window.Echo.channel("socket-tps").listen("TpsCreated", (event) => {
            fetch_user_data_progres();
        });

        window.Echo.channel("socket-tps-detail").listen("TpsDetail", (event) => {
            fetch_user_data_progres();
        });
    })
</script>