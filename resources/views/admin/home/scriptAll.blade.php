<script>
    $(document).ready(function() {

        semuaSuara();

        function semuaSuara() {
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/home/semuaSuara`,
                type: 'get',
                dataType: 'text',
                success: function(data) {
                    $('#output_semua_suara').html(data);
                    semuaSuaraGrafik();
                    afterLoadSuara();
                }
            })
        }

        function semuaSuaraGrafik() {
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/home/semuaSuaraGrafik`,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var ctx = document.getElementById(`semua-suara-chart`);
                    var data = {
                        labels: [
                            'Laki-laki',
                            'Perempuan',
                        ],
                        datasets: [{
                            label: 'Total: ',
                            data: [parseFloat(response.totalDukunganLk), parseFloat(response.totalDukunganPr)],
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
                }
            })
        }

        const afterLoadSuara = () => {
            let wilayahAll = $('.wilayah_all').val();

            function loadTable(wilayahAll = '') {
                var table = $('#table-dashboard-wilayah').DataTable({
                    ajax: {
                        url: "{{ route('admin.home.wilayah') }}",
                        dataType: 'json',
                        type: 'get',
                        data: {
                            wilayah_all: wilayahAll,
                        }
                    },
                });
                return table;
            }

            var table = loadTable(wilayahAll);


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

            $('.wilayah_all').select2({
                theme: 'bootstrap-5'
            });

            $(document).on('click', '.btn-filter-wilayah-all', function(e) {
                e.preventDefault();

                let wilayahAll = $('.wilayah_all').val();
                $('#table-dashboard-wilayah').DataTable().destroy();
                var table = loadTable(wilayahAll);

            })

            $(document).on('click', '.btn-reset-wilayah-all', function(e) {
                e.preventDefault();

                $('.wilayah_all option').attr('selected', false).trigger('change');
                $('#table-dashboard-wilayah').DataTable().destroy();
                var table = loadTable('');
            })
        }
    })
</script>