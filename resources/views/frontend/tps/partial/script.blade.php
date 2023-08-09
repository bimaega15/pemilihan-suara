<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('tps.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });

    })
</script>