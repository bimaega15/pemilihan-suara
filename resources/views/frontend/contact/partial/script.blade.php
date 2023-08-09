<script>
    $(document).ready(function() {
        var dataMaps = loadDataNoAsync();

        function loadDataNoAsync() {
            var output = null;
            $.ajax({
                url: "{{ url('/contactUs') }}",
                method: 'get',
                dataType: 'json',
                async: false,
                success: function(data) {
                    output = data;
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })

            return output;
        }


        // maps
        var map = L.map('map').setView([dataMaps.latitude_konfigurasi, dataMaps.longitude_konfigurasi], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://wa.me/6282277506232">TA.SPK AHP & SAW</a> contributors'
        }).addTo(map);

        var marker = L.marker(new L.LatLng(dataMaps.latitude_konfigurasi, dataMaps.longitude_konfigurasi), {}).addTo(map);
    })
</script>