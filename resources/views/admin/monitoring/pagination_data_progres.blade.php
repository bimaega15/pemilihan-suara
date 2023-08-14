<div class="row">
    @foreach ($data as $item)
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama_tps }}</h5>
                <p class="card-description">
                    <i class="fas fa-map-marker-alt"></i> Kelurahan: {{ $item->villages->name }} <br>
                    <i class="fas fa-map-marker-alt"></i> Alamat: {{ $item->alamat_tps }} <br>
                    <i class="fas fa-user-tie"></i> Koordinator: {{ Check::getUsersId($item->users_id) }} <br>
                </p>
                <hr>
                <p class="card-description">
                    <i class="fas fa-map-marker-alt"></i> Total Suara: {{ $item->totalsemua_tps }} <br>
                    <i class="fas fa-map-marker-alt"></i> Minimal Suara: {{ $item->minimal_tps }} <br>
                    <i class="fas fa-user-tie"></i> Target Suara: {{ $item->pendukung_tps }} <br>
                </p>
                <div class="progress">
                    @php
                    $presentase = (intval($item->totalsemua_tps) / intval($item->pendukung_tps)) * 100;
                    $setPresentase = $presentase.'%';

                    $class = 'bg-info';
                    if($presentase < $item->minimal_tps){
                        $class = 'bg-danger';
                        }
                        if($presentase >= 100){
                        $class = 'bg-success';
                        }
                        @endphp
                        <div class="progress-bar progress-bar-striped {{ $class }} progress-bar-animated" role="progressbar" aria-valuenow="{{ $item->totalsemua_tps }}" aria-valuemin="{{ $item->minimal_tps }}" aria-valuemax="{{ $item->pendukung_tps }}" style="width: {{ $setPresentase }};" data-title="Presentase: {{ $setPresentase }};">
                            {{$setPresentase}}
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-end">
            {!! $data->links() !!}
        </div>
    </div>
</div>