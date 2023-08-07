<script>
    $(document).ready(function(e) {
        var table = $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('admin.monitoring.detail', $tps_id) }}",
                data: {
                    tps_id: "{{ $tps_id }}"
                },
                dataType: 'json',
                type: 'get',
            },
        });

        // initialize manually with a list of links
        $(document).on('click', '[data-gallery="photoviewer"]', function(e) {
            e.preventDefault();
            var items = [],
                options = {
                    index: $('.photoviewer').index(this),
                };

            $('[data-gallery="photoviewer"]').each(function() {
                items.push({
                    src: $(this).attr('href'),
                    title: $(this).attr('data-title')
                });
            });

            new PhotoViewer(items, options);
        });

    })
</script>