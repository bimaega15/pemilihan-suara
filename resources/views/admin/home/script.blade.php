<script>
    $(document).ready(function() {
        // const ctx = document.getElementById('myChart');

        // new Chart(ctx, {
        //     type: 'pie',
        //     data: {
        //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //         datasets: [{
        //             label: '# of Votes',
        //             data: [12, 19, 3, 5, 2, 3],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });



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

        fetch_user_data_grafik();

        function fetch_display_grafik(page = 1, setData = {}) {
            var output = null;
            let url = "{{ url('/') }}";

            $.ajax({
                url: `${url}/admin/home/fetchDisplayGrafik?page=` + page,
                data: setData,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
                }
            });
            return output;
        }

        function fetch_user_data_grafik(page = 1, setData = {}) {
            let url = "{{ url('/') }}";

            $.ajax({
                url: `${url}/admin/home/fetchGrafik?page=` + page,
                data: setData,
                success: function(data) {
                    $('#output_grafik').html(data);

                    let getOutput = fetch_display_grafik(page, setData);
                    if (getOutput.data != null) {
                        getOutput.data.map((v, i) => {

                            let id = v.id;
                            let totallk_tps = v.totallk_tps;
                            let totalpr_tps = v.totalpr_tps;

                            var ctx = document.getElementById(`myChart_${id}`);
                            var data = {
                                labels: [
                                    'Laki-laki',
                                    'Perempuan',
                                ],
                                datasets: [{
                                    label: 'Total: ',
                                    data: [parseFloat(totallk_tps), parseFloat(totalpr_tps)],
                                    backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                    ],
                                    hoverOffset: 4
                                }]
                            };

                            var config = {
                                type: 'pie',
                                data: data,
                            };
                            new Chart(ctx, config);
                        })
                    }
                }
            });
        }

        $(document).on('click', '#output_grafik .pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_user_data_grafik(page);
        })


        function whereDataGrafik() {
            let provinces_id = $('.provinces_id').val();
            let regencies_id = $('.regencies_id').val();
            let districts_id = $('.districts_id').val();
            let villages_id = $('.villages_id').val();

            return {
                provinces_id,
                regencies_id,
                districts_id,
                villages_id
            }
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
            let active = $('#output_grafik ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataGrafik();
            fetch_user_data_grafik(active, getWhere);
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
            let active = $('#output_grafik ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataGrafik();
            fetch_user_data_grafik(active, getWhere);
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
            let active = $('#output_grafik ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataGrafik();
            fetch_user_data_grafik(active, getWhere);
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

        $(document).on('change', '.villages_id', function() {
            let value = $(this).val();
            let active = $('#output_grafik ul.pagination li.page-item.active span.page-link').text();
            let getWhere = whereDataGrafik();
            fetch_user_data_grafik(active, getWhere);
        })

        function whereResetGrafik() {
            $('.provinces_id option').remove();
            $('.regencies_id option').remove();
            $('.districts_id option').remove();
            $('.villages_id option').remove();

            return {
                provinces_id: '',
                regencies_id: '',
                districts_id: '',
                villages_id: ''
            }
        }
        $(document).on('click', '.btn-reset-wilayah', function(e) {
            e.preventDefault();
            let getWhere = whereResetGrafik();
            let active = $('#output_grafik ul.pagination li.page-item.active span.page-link').text();
            fetch_user_data_grafik(1, getWhere);
        })

        window.Echo.channel("socket-tps").listen("TpsCreated", (event) => {
            fetch_user_data_grafik();
        });

        window.Echo.channel("socket-tps-detail").listen("TpsDetail", (event) => {
            fetch_user_data_grafik();
        });
    })
</script>