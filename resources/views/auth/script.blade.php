<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('register.index') }}",
                dataType: 'json',
                type: 'get',
            },
        });

        $('.select2').select2({
            theme: 'bootstrap-5'
        });
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
                            html: data.message,
                            showConfirmButton: true,
                        }).then((res) => {
                            let url = `{{ url('/') }}`;
                            window.location.href = url + '/login';
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
                            html: data.message,
                            showConfirmButton: false,
                            timer: 1500
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
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Perhatikan kembali form anda dengan benar',
                            showConfirmButton: false,
                            timer: 1500
                        })
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

        let owl = $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
            }
        })

        owl.owlCarousel();
        // Go to the next item
        $('.customNextBtn').click(function() {
            owl.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.customPrevBtn').click(function() {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl.trigger('prev.owl.carousel', [300]);
        })


        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");
            owl.trigger('to.owl.carousel', 0)

            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.detail-tps', function(e) {
            e.preventDefault();
            $('#modalForm').modal('show');
        })

        $(document).on('click', '.btn-choose-tps', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/register/${id}/getTps`,
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    let countUsersId = 0;
                    if (data.users_id != null) {
                        countUsersId = data.users_id.split(',');
                        countUsersId = countUsersId.length;
                    }
                    let userPlusKuota = parseInt(countUsersId) + parseInt(1);
                    if (userPlusKuota > parseInt(data.kuota_tps)) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Info TPS',
                            text: 'Kuota TPS Sudah penuh silahkan untuk mendaftar ke TPS lainnya',
                            showConfirmButton: true,
                        }).then(() => {
                            resetTps();
                        })
                        return;
                    }

                    $('span#kuota_tps').html(data.kuota_tps);
                    $('input.tps_id').val(data.id);
                    $('span#users_id').html(countUsersId);
                    $('span#provinces_id').html(data.provinces.name);
                    $('span#districts_id').html(data.regencies.name);
                    $('span#regencies_id').html(data.districts.name);
                    $('span#villages_id').html(data.villages.name);
                    $('span#alamat_tps').html(data.alamat_tps);

                    $('#modalForm').modal('hide');
                    $('#outputNoData').addClass('d-none');
                    $('#outputTps').removeClass('d-none');
                }
            })
        })

        function resetTps() {
            $('span#kuota_tps').html('');
            $('input.tps_id').val('');
            $('span#users_id').html('');
            $('span#provinces_id').html('');
            $('span#districts_id').html('');
            $('span#regencies_id').html('');
            $('span#villages_id').html('');
            $('span#alamat_tps').html('');
        }

        $(document).on('click', '.btn-cancel-tps', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Batal TPS',
                text: "Anda yakin ingin membatalkan TPS ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#outputNoData').removeClass('d-none');
                    $('#outputTps').addClass('d-none');

                    resetTps();
                }
            })
        })
    })
</script>