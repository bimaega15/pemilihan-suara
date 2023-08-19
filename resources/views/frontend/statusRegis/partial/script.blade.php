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

    })
</script>