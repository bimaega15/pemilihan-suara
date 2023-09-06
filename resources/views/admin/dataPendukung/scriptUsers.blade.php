<script>
    $(document).ready(function(e) {
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

        function loadDynamic() {
            let setUrl = "{{ url('/') }}";
            var output = null;
            $.ajax({
                url: `${setUrl}/admin/users/getRoles`,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
                }
            })
            return output;
        }
        let getDynamic = loadDynamic();


        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modalForm')
        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            resetForm();

            $('input[name="_method"]').val('post');
            let url = "{{ url('/') }}";
            $('.form-submit-users').attr('action', url + '/admin/users');
            let roles = $(this).data('roles');
            roles = roles.split('-').join(' ');
            roles = roles.toLowerCase();

            let checkRoles = getDynamic.role.find((v, i) => v.nama_roles.toLowerCase() == roles);
            if (checkRoles != null) {
                if (roles == 'pendukung') {
                    $('#div_account').addClass('d-none');
                    owl.trigger('to.owl.carousel', 1);
                    $('.customPrevBtn').addClass('d-none');

                    $('.role_id').val(checkRoles.id);

                    $('.label-image-photo').html('Upload KTP');
                } else {
                    $('.role_id').val(checkRoles.id);
                }
            }

        })


        function resetForm(attribute = null) {
            $('.jabatan_id option').attr('selected', false).trigger('change');
            $('.form-submit-users').trigger("reset");

            $('#div_account').removeClass('d-none');
            owl.trigger('to.owl.carousel', 0);
            $('.customPrevBtn').removeClass('d-none');

            $('.label-image-photo').html('Upload Photo');
            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        $(document).on('click', '.btn-submit-users', function(e) {
            e.preventDefault();
            $('.form-submit-users').submit();
        })

        $(document).on('submit', '.form-submit-users', function(e) {
            e.preventDefault();
            var form = $('.form-submit-users')[0];
            var data = new FormData(form);
            var action = $('.form-submit-users').attr('action');
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
                    $('.btn-submit-users').attr('disabled', true);
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

                        $('#modalForm').modal('hide');
                        let roles = $('.role_id').val();

                        for (let i = 0; i < getDynamic.role.length; i++) {
                            const element = getDynamic.role[i];
                            let nameRoles = element.nama_roles.split(' ').join('-');
                            nameRoles = nameRoles.toLowerCase();

                            let rolesId = element.id;
                            if (rolesId == roles) {
                                $(`#table-${nameRoles}`).DataTable().ajax.reload();
                            }
                        }


                        const {
                            result
                        } = data;
                        resetForm(result);
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
                    $('.btn-submit-users').attr('disabled', false);
                }
            });
        }


        // Go to the next item
        $('.customNextBtn').click(function() {
            owl.trigger('next.owl.carousel');
        })

        // Go to the previous item
        $('.customPrevBtn').click(function() {
            owl.trigger('prev.owl.carousel', [300]);
        })

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