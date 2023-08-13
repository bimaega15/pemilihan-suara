<script>
    $(document).ready(function() {
        var table = $('#dataTableTps').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('admin.pendukung.tpsPendukung') }}",
                dataType: 'json',
                type: 'get',
            },
        });
        $(document).on('click', '.detail-tps', function(e) {
            e.preventDefault();
            $('#modalFormTps').modal('show');
        })

        $(document).on('click', '.btn-choose-tps', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let setUrl = "{{ url('/') }}";
            $.ajax({
                url: `${setUrl}/admin/pendukung/${id}/getTps`,
                dataType: 'json',
                type: 'get',
                success: function(data) {

                    $('span#kuota_tps').html(data.kuota_tps);
                    $('input.tps_id').val(data.id);
                    $('span#provinces_id').html(data.provinces.name);
                    $('span#districts_id').html(data.regencies.name);
                    $('span#regencies_id').html(data.districts.name);
                    $('span#villages_id').html(data.villages.name);
                    $('span#alamat_tps').html(data.alamat_tps);

                    $('#modalFormTps').modal('hide');
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