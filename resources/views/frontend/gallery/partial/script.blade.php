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
                dataType: 'json',
                type: 'get',
                success: function(res) {

                    let assetGallery = "{{ asset('upload/gallery/') }}";
                    let result = res.data;
                    let outputData = `<div class="row">`;
                    for (let i = 0; i < result.length; i++) {
                        let rowData = result[i];
                        outputData += `
                    <!-- post Item #1 -->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="post-item">
                            <div class="post__img">
                                <a class="photoviewer" data-gallery="photoviewer" href="${assetGallery}/${rowData.gambar_gallery}" data-title="${rowData.gambar_gallery}">
                                    <img src="${assetGallery}/${rowData.gambar_gallery}" alt="${rowData.gambar_gallery}" style="width: 100%; height: 300px;">
                                </a>
                            </div><!-- /.post-img -->
                            <div class="post__content"> 
                                <h4 class="post__title" style="text-align:center;">
                                <a href="#">
                                ${rowData.judul_gallery}
                                </a>
                                </h4>
                                
                                
                            </div><!-- /.post-content -->
                        </div><!-- /.post-item -->
                    </div><!-- /.col-lg-4 -->
                    `;
                    }
                    outputData += `</div>`;

                    outputData += `
                    <div class="row">`;


                    let dataLinks = res.links;

                    let nextPageUrl = res.next_page_url;
                    let prevPageUrl = res.prev_page_url;


                    outputData += `
            <div class="col-12 text-center">
                <nav class="pagination-area">
                    <ul class="pagination justify-content-center mb-0">`;
                    if (prevPageUrl == null) {
                        outputData += `
                            <li><a href="#" disabled class="btn-get-page"><i class="icon-arrow-left" style="font-size: 65%;"></i></a></li>
                        `;
                    } else {
                        outputData += `
                            <li><a href="${prevPageUrl}" class="btn-get-page"><i class="icon-arrow-left" style="font-size: 65%;"></i></a></li>
                        `;
                    }
                    let lastIndex = parseInt(dataLinks.length) - 1;


                    dataLinks.map((v, i) => {
                        let getUrl = v.url;
                        let getLabel = v.label;
                        let getActive = v.active;
                        if (i != 0 && i != lastIndex) {
                            outputData += `
                                     <li class="${getActive ? 'current' : ''}"><a href="${getUrl}" class="btn-get-page ${getActive ? 'current' : ''}">${getLabel}</a></li>
                                                    `;
                        }

                    })

                    if (nextPageUrl == null) {
                        outputData += `
                            <li><a href="#" disabled class="btn-get-page"><i class="icon-arrow-right"></i></a></li>
                        `;
                    } else {
                        outputData += `
                            <li><a href="${nextPageUrl}" class="btn-get-page"><i class="icon-arrow-right"></i></a></li>
                        `;
                    }

                    outputData += `
                    </ul>
                </nav><!-- .pagination-area -->
            </div><!-- /.col-12 -->
                    `;

                    outputData += `
                    </div><!-- /.row -->
                    `;



                    $('#contentGallery').html(`
                    <div class="text-center">
                        ${outputData}
                    </div>
                    `);
                },
                complete: function() {


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

        $(document).on('click', '.btn-get-page', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url != '#') {
                getLoadData(url);
            }
        })
    })
</script>