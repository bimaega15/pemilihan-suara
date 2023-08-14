<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('tps.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });

        window.Echo.channel("socket-tps").listen("TpsCreated", (event) => {
            table.ajax.reload();
        });

        window.Echo.channel("socket-tps-detail").listen("TpsDetail", (event) => {
            table.ajax.reload();
        });

    })
</script>