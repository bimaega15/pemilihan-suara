<script>
    $(document).ready(function() {
        var setUrlToBe = "{{ url('/gallery?page=1') }}"
        getLoadData(setUrlToBe);

        function getLoadData(page = setUrlToBe) {
            let splitPage = page.split("?page=");
            let setPage = splitPage[1];

            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/gallery?page=${setPage}`,
                dataType: 'text',
                type: 'get',
                success: function(res) {
                    $('#contentGallery').html(res);
                },
                complete: function() {
                    var target = $('#contentGallery');
                    if (target.length) {
                        var top = target.offset().top - 100;
                        $('html,body').animate({
                            scrollTop: top
                        }, 1000);
                    }

                }
            })
        }

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

        $(document).on('click', '.page-item .page-link', function(e) {
            e.preventDefault();
            let href = $(this).attr('href');
            getLoadData(href);
        })

    })
</script>