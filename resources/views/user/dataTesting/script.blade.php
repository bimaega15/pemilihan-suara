<script>
    $(document).ready(function() {

        $('.datePicker').datepicker({
            todayBtn: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        loadDataKuisioner();

        function loadDataKuisioner(url = "{{ url('/admin/dataTesting') }}") {
            $.ajax({
                url,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    const {
                        jawabanKuisioner,
                        kuisioner
                    } = data;

                    let dataStoreSession = getStoreSession();

                    let outputData = ``;
                    let number = kuisioner.from;
                    kuisioner.data.map((v, i) => {
                        outputData +=
                            `
                        <div class="mb-4">
                            <p style="font-size: 18px; margin-bottom: 4px;">${number}) [${v.kode_kuisioner}] ${v.soal_kuisioner}</p>`;

                        jawabanKuisioner.map((data, idata) => {

                            let checked = '';
                            if (dataStoreSession[v.id] == data.id) {
                                checked = 'checked';
                            }

                            outputData += `
                        <div style="padding-left: 0px;" class="form-check form-check-inline">
                            <input id="radio-${v.id}-${data.id}" class="radio-custom check-data-testing" name="radio-group-${v.id}" type="radio" value="${data.id}" data-kuisioner_id="${v.id}" data-jawaban_kuisioner_id="${data.id}" ${checked}>
                            <label for="radio-${v.id}-${data.id}" class="radio-custom-label">${data.nama_jawaban_kuisioner}</label>
                        </div>
                                `;
                        })

                        outputData += `
                        </div>
                        `;

                        number++;
                    })
                    $('#content').html(`
                    <h4>Kuisioner Biodata</h4>
                    <hr>
                    ${outputData}
                    `);

                    let outputLink = null;
                    if (kuisioner.prev_page_url != null) {
                        outputLink =
                            `
                    <div class="d-flex justify-content-end">
                        <button type="button" data-href="${kuisioner.prev_page_url}" class="btn btn-secondary me-3 shadow-sm px-5 btn-prev"><i class="fa-sharp fa-solid fa-arrow-left font-weight-bold"></i></button>`;
                    } else {
                        outputLink =
                            `
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-3 shadow-sm px-5 btn-biodata"><i class="fa-sharp fa-solid fa-arrow-left font-weight-bold"></i></button>`;
                    }


                    if (kuisioner.next_page_url != null) {
                        outputLink += `
                        <button type="button" data-href="${kuisioner.next_page_url}" class="btn btn-secondary shadow-sm px-5 btn-next" ${kuisioner.next_page_url == null ? 'disabled' : ''}><i class="fa-sharp fa-solid fa-arrow-right font-weight-bold"></i></button>
                    </div>
                    `;
                    } else {
                        let url = "{{ url('/') }}";
                        outputLink += `
                        <button type="button" data-href="${url}/dataTesting/store" class="btn btn-primary shadow-sm px-5 btn-submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                    `;
                    }


                    $('#link_content').html(outputLink);
                },
                error: function(x, t, m) {
                    const {
                        responseText,
                        responseJSON
                    } = x;
                    if (responseText != '') {
                        console.log(responseText);
                    }
                }
            })
        }

        $(document).on('click', '.btn-prev', function(e) {
            e.preventDefault();
            let href = $(this).data('href');

            loadDataKuisioner(href);
        })

        $(document).on('click', '.btn-next', function(e) {
            e.preventDefault();
            let href = $(this).data('href');

            loadDataKuisioner(href);
        })

        $(document).on('click', '.check-data-testing', function() {
            let kuisioner_id = $(this).data('kuisioner_id');
            let jawaban_kuisioner_id = $(this).data('jawaban_kuisioner_id');
            let url = "{{ url('/') }}";
            $.ajax({
                url: `${url}/admin/dataTesting/storeSession`,
                type: 'get',
                dataType: 'json',
                data: {
                    kuisioner_id,
                    jawaban_kuisioner_id
                },
                success: function(data) {
                    console.log(data);
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
        })

        function getStoreSession() {
            let url = "{{ url('/') }}";
            var output = null;
            $.ajax({
                url: `${url}/admin/dataTesting/getStoreSession`,
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
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

            return output;
        }

        function resetForm(attribute = null) {
            if (attribute != null && attribute != '') {
                $.each(attribute, function(v, i) {
                    $('.' + v).removeClass("border border-danger");
                    $('.error_' + v).html('');
                })
            }
        }

        function loadData() {
            let count_kuisioner = $('.count_kuisioner').val();
            let tanggal_user_diagnosa = $('.tanggal_user_diagnosa').val();
            let judul_user_diagnosa = $('.judul_user_diagnosa').val();
            let nama_user_diagnosa = $('.nama_user_diagnosa').val();
            let jenis_kelamin_user_diagnosa = $('.jenis_kelamin_user_diagnosa').val();
            let nomor_hp_user_diagnosa = $('.nomor_hp_user_diagnosa').val();
            let email_user_diagnosa = $('.email_user_diagnosa').val();
            let alamat_user_diagnosa = $('.alamat_user_diagnosa').val();
            let usia_user_diagnosa = $('.usia_user_diagnosa').val();

            var output = {};
            output.count_kuisioner = count_kuisioner;
            output.tanggal_user_diagnosa = tanggal_user_diagnosa;
            output.judul_user_diagnosa = judul_user_diagnosa;
            output.nama_user_diagnosa = nama_user_diagnosa;
            output.jenis_kelamin_user_diagnosa = jenis_kelamin_user_diagnosa;
            output.nomor_hp_user_diagnosa = nomor_hp_user_diagnosa;
            output.email_user_diagnosa = email_user_diagnosa;
            output.alamat_user_diagnosa = alamat_user_diagnosa;
            output.usia_user_diagnosa = usia_user_diagnosa;
            return output;
        }

        $(document).on('click', '.btn-submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: "Apakah semua inputan sudah terisi dengan benar, dan ingin submit kuisioner ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let getData = loadData();
                    let url = "{{ url('/') }}";
                    $.ajax({
                        url: `${url}/admin/dataTesting/store`,
                        type: 'post',
                        dataType: 'json',
                        data: loadData(),
                        success: function(data) {
                            if (data.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(res => {
                                    let url = "{{ url('/') }}";
                                    window.location.href =
                                        `${url}/admin/hasil`;
                                })
                            }
                        },
                        error: function(xhr) {
                            const {
                                responseText,
                                responseJSON
                            } = xhr;
                            if (responseText != '') {
                                console.log(responseText);
                            }
                            if (responseJSON != null) {
                                const {
                                    result
                                } = responseJSON;
                                if (result.count_kuisioner != null) {
                                    if (result.count_kuisioner[0] != null) {
                                        let message = result.count_kuisioner[0];

                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Fail',
                                            text: message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    }
                                }

                                if (responseJSON.result != undefined) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Fail',
                                        text: 'Perhatikan kembali inputan anda',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                    let outputResult = responseJSON.result;
                                    $.each(outputResult, function(v, i) {
                                        let textError = outputResult[v][0];
                                        let keyError = v;
                                        $('.' + keyError).addClass(
                                            "border border-danger");
                                        $('.error_' + keyError).html(
                                            textError);
                                    })
                                }
                            }
                        }
                    })
                }
            });
        })

        $(document).on('click', '.btn-kuisioner', function(e) {
            e.preventDefault();
            $('#content').removeClass('d-none');
            $('#link_content').removeClass('d-none');

            $('#userDiagnosa').addClass('d-none');
        })

        $(document).on('click', '.btn-biodata', function(e) {
            e.preventDefault();
            $('#content').addClass('d-none');
            $('#link_content').addClass('d-none');

            $('#userDiagnosa').removeClass('d-none');
        })
    })
</script>
