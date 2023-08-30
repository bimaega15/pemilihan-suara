<script>
    $(document).ready(function(e) {
        $('.summernote').summernote({
            height: 300
        });

        var dataMaps = loadDataNoAsync();

        function loadDataNoAsync() {
            var output = null;
            $.ajax({
                url: "{{ url('/admin/konfigurasi') }}",
                method: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    const {
                        result
                    } = data;

                    output = result;
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })

            return output;
        }

        loadData();

        function loadData() {
            $.ajax({
                url: "{{ url('/admin/konfigurasi') }}",
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        result
                    } = data;

                    let root = "{{ asset('/') }}"
                    if (result != null && result != '') {
                        $('.id').val(result.id);
                        $('.page').val('edit');
                        $('.nama_konfigurasi').val(result.nama_konfigurasi);
                        $('.nohp_konfigurasi').val(result.nohp_konfigurasi);
                        $('.alamat_konfigurasi').val(result.alamat_konfigurasi);
                        $('.email_konfigurasi').val(result.email_konfigurasi);
                        $('.created_konfigurasi').val(result.created_konfigurasi);
                        $('.deskripsi_konfigurasi').val(result.deskripsi_konfigurasi);
                        $('.longitude_konfigurasi').val(result.longitude_konfigurasi);
                        $('.latitude_konfigurasi').val(result.latitude_konfigurasi);
                        $('.cominimal_konfigurasi').val(result.cominimal_konfigurasi);
                        $('.volminimal_konfigurasi').val(result.volminimal_konfigurasi);

                        $('.summernote').summernote('editor.pasteHTML', result.deskripsi_konfigurasi);


                        let linkGambar =
                            `${root}upload/konfigurasi/${result.logo_konfigurasi}`;
                        $('#load_logo_konfigurasi').html(`
                    <a class="photoviewer" href="${linkGambar}" data-gallery="photoviewer" data-title="${result.logo_konfigurasi}">
                        <img width="150px;" class="img-thumbnail" src="${linkGambar}"></img>    
                    </a>
                    `);
                    } else {
                        $('.page').val('edit');
                    }

                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        }

        function resetForm(attribute = null) {
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
        })

        function onSubmit(action, data) {
            $.ajax({
                url: action,
                type: "POST",
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
                        })


                        const {
                            result
                        } = data;
                        resetForm(result);
                    }

                    if (data.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalForm').modal('hide');
                        table.ajax.reload();
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


        // maps
        var map = L.map('map-contact').setView([dataMaps.latitude_konfigurasi, dataMaps.longitude_konfigurasi], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://wa.me/6282277506232">Rancang Bangun Aplikasi Pengelolaan Suara</a> contributors'
        }).addTo(map);
        L.Control.geocoder().addTo(map);


        var marker = L.marker(new L.LatLng(dataMaps.latitude_konfigurasi, dataMaps.longitude_konfigurasi), {
            draggable: true
        }).addTo(map);

        marker.on('dragend', function(e) {
            let latitude = marker.getLatLng().lat;
            let longitude = marker.getLatLng().lng;

            $('.latitude_konfigurasi').val(latitude);
            $('.longitude_konfigurasi').val(longitude);
        })

        map.on('click', function(e) {
            var popLocation = e.latlng;
            let longitude = popLocation.lng;
            let latitude = popLocation.lat;

            var popup = L.popup()
                .setLatLng(popLocation)
                .setContent(`<p>Hello User!<br />
                Apakah anda ingin set lokasi ini <br /> 
                menjadi alamat peta ?
                <hr />
                <div class="d-flex justify-content-end">
                    <button class="badge bg-primary btn-confirm-map" type="button" data-longitude="${longitude}" data-latitude="${latitude}">
                        Iya Saya Yakin
                    </button>
                </div>
                </p>`)
                .openOn(map);

        });


        $(document).on('click', '.btn-confirm-map', function() {
            let longitude = $(this).data('longitude');
            let latitude = $(this).data('latitude');

            $('.longitude_konfigurasi').val(longitude);
            $('.latitude_konfigurasi').val(latitude);

            var newLatLng = new L.LatLng(latitude, longitude);
            marker.setLatLng(newLatLng);
        })
    })
</script>