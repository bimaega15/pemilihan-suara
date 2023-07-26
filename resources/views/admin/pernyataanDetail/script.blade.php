<script>
    $(document).ready(function(e) {
        $(document).on('change', '.kuisioner_id', function() {
            let kuisioner_id = $(this).data('kuisioner_id');
            let value = $(this).val();
            let bobot_jawaban_kuisioner = $('.kuisioner_id[data-kuisioner_id="' + kuisioner_id + '"] option[value="' + value + '"]').data('bobot_jawaban_kuisioner');

            $('.bobot-jawaban-kuisioner[data-kuisioner_id="' + kuisioner_id + '"]').val(bobot_jawaban_kuisioner);

        })

        function resetForm(attribute = null) {
            $('.form-submit').trigger("reset");
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

        function getPassData() {
            let kuisioner_id = $('.kuisioner_id');
            let pushData = [];
            $.each(kuisioner_id, function() {
                let dataKuisionerId = $(this).data('kuisioner_id');
                let jawabanKuisionerId = $(this).find('option:selected').val();

                if (jawabanKuisionerId != '') {
                    pushData.push({
                        kuisioner_id: dataKuisionerId,
                        jawaban_kuisioner_id: jawabanKuisionerId
                    })
                }
            })

            return pushData;
        }

        $(document).on('submit', '.form-submit', function(e) {
            e.preventDefault();

            let getData = getPassData();

            var pushData = {};
            pushData.kuisioner_jawaban = getData;
            pushData.count_kuisioner = $('.count_kuisioner').val();
            pushData.pernyataan_id = $('.pernyataan_id').val();

            var data = pushData;
            var action = $('.form-submit').attr('action');
            onSubmit(action, data);
        })

        function onSubmit(action, data) {
            $.ajax({
                url: action,
                type: "POST",
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $('.btn-submit').attr('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
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
                        const {
                            result
                        } = responseJSON;

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: result.kuisioner_jawaban[0],
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                complete: function() {
                    $('.btn-submit').attr('disabled', false);
                }
            });
        }

        getDataJawabanDetail();

        function getDataJawabanDetail() {
            let url = "{{ url('') }}";
            let id = "{{ $id }}";

            $.ajax({
                url: `${url}/admin/pernyataanDetail/${id}/index`,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        const {
                            result
                        } = data;

                        result.map((v, i) => {
                            $(`.kuisioner_id[data-kuisioner_id="${v.kuisioner_id}"] option[value="${v.jawaban_kuisioner_id}"]`).attr('selected', true);
                            $(`.bobot-jawaban-kuisioner[data-kuisioner_id="${v.kuisioner_id}"]`).val(v.jawaban_kuisioner.bobot_jawaban_kuisioner);
                        })
                    }
                },
                error: function(xhr) {
                    const {
                        responseText
                    } = xhr;

                    if (responseText != '') {
                        console.log(responseText);
                    }
                }
            })
        }


    })
</script>