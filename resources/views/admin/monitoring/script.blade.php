<script>
    $(document).ready(function() {
        $('#dataTableKoordinatorPendukung').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('admin.monitoring.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });
    })
</script>