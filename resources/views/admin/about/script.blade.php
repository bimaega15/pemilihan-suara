<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function(e) {
        var table = $('#dataTable')
            .DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                search: {
                    caseInsensitive: true,
                },
                searchHighlight: true,
                ajax: "{{ route('admin.about.index') }}",
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                    },
                    {
                        data: "project_about",
                        name: "project_about",
                        searchable: true
                    },
                    {
                        data: "customers_about",
                        name: "customers_about",
                        searchable: true
                    },
                    {
                        data: "team_about",
                        name: "team_about",
                        searchable: true
                    },
                    {
                        data: "awards_about",
                        name: "awards_about",
                        searchable: true
                    },
                    {
                        data: "gambar_about",
                        name: "gambar_about",
                        searchable: true
                    },
                    {
                        data: "about_aktif",
                        name: "about_aktif",
                        searchable: true
                    },
                    {
                        data: "action",
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function(settings) {
                    var info = table.page.info();
                    table
                        .column(0, {
                            search: "applied",
                            order: "applied"
                        })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = info.start + i + 1;
                        });
                },
            });


        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");

            $('.input-teamdetail_about').html('');
            $('.input-teamdetail_about').imageUploader({
                imagesInputName: 'teamdetail_about',
                preloadedInputName: 'old'
            });

            $('.input-gambarsponsor_about').html('');
            $('.input-gambarsponsor_about').imageUploader({
                imagesInputName: 'gambarsponsor_about',
                preloadedInputName: 'old'
            });

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            $('.form-submit').submit();
        })

        $(document).on('submit', '.form-submit', function(e) {
            e.preventDefault();
            var form = $('.form-submit')[0];
            var data = new FormData(form);
            var action = $('.form-submit').attr('action');
            onSubmit(action, data);

            data.append('keterangan_about', editor.getData());
        })

        function onSubmit(action, data) {
            $.ajax({
                url: action,
                type: 'post',
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.btn-submit').attr('disabled', true);
                },
                success: function(data) {
                    if (data.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            resetForm();
                            let getUrl = "{{ url('/') }}";
                            window.location.href = `${getUrl}/admin/about`;
                        })
                    }
                },
                error: function(xhr) {
                    const {
                        responseJSON,
                        responseText
                    } = xhr;
                    if (responseText != null) {
                        console.log(responseText);
                    }

                    if (responseJSON.result != undefined) {
                        let outputResult = responseJSON.result;
                        $.each(outputResult, function(v, i) {
                            let textError = outputResult[v][0];
                            let keyError = v;
                            $('.' + keyError).addClass("border border-danger");
                            $('.error_' + keyError).html(textError);
                        })
                    }
                },
                complete: function() {
                    $('.btn-submit').attr('disabled', false);
                }
            });
        }

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const action = $(this).closest("form").attr('action');
            Swal.fire({
                title: 'Deleted',
                text: "Yakin ingin menghapus item ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action,
                        dataType: 'json',
                        type: 'post',
                        method: 'DELETE',
                        success: function(data) {
                            if (data.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                );
                                table.ajax.reload();

                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'error'
                                )
                            }

                        },
                        error: function(x, t, m) {
                            console.log(x.responseText);
                        }
                    })
                }
            })
        })

        let editor;

        ClassicEditor.create(document.getElementById("editor"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Isi Content About...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents'
                ]
            }).then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });

        $('.input-teamdetail_about').imageUploader({
            imagesInputName: 'teamdetail_about',
            preloadedInputName: 'old'
        });

        $('.input-gambarsponsor_about').imageUploader({
            imagesInputName: 'gambarsponsor_about',
            preloadedInputName: 'old'
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

        $(document).on('click', '.delete-gambar-team', function(e) {
            e.preventDefault();
            let value = $(this).data('gambar_type');
            let id = $(this).data('id');
            let type = $(this).data('type');

            Swal.fire({
                title: 'Deleted',
                text: "Yakin ingin menghapus item ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteGambarMultiple(value, id, type);
                }
            })
        })

        function deleteGambarMultiple(value, id, type) {
            let url = "{{ url('/') }}";

            $.ajax({
                url: `${url}/admin/about/deleteMultipleImage`,
                type: 'post',
                data: {
                    value,
                    id,
                    type
                },
                dataType: 'json',
                success: function(data) {
                    const {
                        output
                    } = data;
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        resetForm();
                        let getUrl = "{{ url('/') }}";

                        let outputTeamDetail = `
                        <div class="row">
                        `;
                        $getAbout = output.about;
                        let publicPath = "{{ asset('/') }}"

                        output.teamdetail_about.map((v, i) => {
                            outputTeamDetail += `
                            <div class="col-lg-3">
                                <div class="text-center p-3" style="border: 1px solid #61677A; position: relative;">
                                    <a href="#" class="py-2 shadow-sm bg-danger text-white delete-gambar-team" data-id="${$getAbout.id}" style="border-radius: 50%; padding: 1px 14px; border: 1px solid #F31559; position: absolute; top: 0; right: 0;" data-gambar_type="${v}" data-type="team">
                                        <i class="fas fa-times text-white fa-1x"></i>
                                    </a>
                                    <a class="photoviewer" href="${publicPath}upload/about/team/${v}" data-gallery="photoviewer" data-title="${v}">
                                        <img src="${publicPath}upload/about/team/${v}" alt="" style="height: 150px; width: 100%;">
                                    </a>
                                </div>
                            </div>
                            `;
                        })
                        outputTeamDetail += `
                        </div>
                        `;
                        $('#load-teamdetail_about').html(outputTeamDetail);


                        let outputGambarSponsor = `
                        <div class="row">
                        `;
                        output.gambarsponsor_about.map((v, i) => {
                            outputGambarSponsor += `
                            <div class="col-lg-3">
                                <div class="text-center p-3" style="border: 1px solid #61677A; position: relative;">
                                    <a href="#" class="py-2 shadow-sm bg-danger text-white delete-gambar-team" data-id="${$getAbout.id}" style="border-radius: 50%; padding: 1px 14px; border: 1px solid #F31559; position: absolute; top: 0; right: 0;" data-gambar_type="${v}" data-type="sponsor">
                                        <i class="fas fa-times text-white fa-1x"></i>
                                    </a>
                                    <a class="photoviewer" href="${publicPath}upload/about/sponsor/${v}" data-gallery="photoviewer" data-title="${v}">
                                        <img src="${publicPath}upload/about/sponsor/${v}" alt="" style="height: 150px; width: 100%;">
                                    </a>
                                </div>
                            </div>
                            `;
                        })
                        outputGambarSponsor += `
                        </div>
                        `;
                        $('#load-gambarsponsor_about').html(outputGambarSponsor);
                    })
                }
            })
        }

        $(document).on('click', '.check-input', function(e) {
            let id = $(this).data('id');
            let url = $(this).data('url');
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: {
                    id,
                    id
                },
                success: function() {
                    table.ajax.reload();
                }
            })
        })
    })
</script>