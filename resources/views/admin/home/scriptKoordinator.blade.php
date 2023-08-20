<script>
    $(document).ready(function() {
        viewData();

        function viewData() {
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/home/suaraKoordinator`,
                type: 'get',
                dataType: 'text',
                success: function(data) {
                    $('#output_suara_koordinator').html(data);
                    suaraKoordinatorGrafik();
                }
            })
        }

        function suaraKoordinatorGrafik() {
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/home/suaraKoordinatorGrafik`,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var ctx = document.getElementById(`chart-koordinator`);
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

    })
</script>