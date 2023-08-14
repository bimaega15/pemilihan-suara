    <div class="row">
        @foreach ($data as $item)
        <div class="col-lg-3">
            <div style="width: 100%;" class="card shadow">
                <div class="card-header">
                    <h5><i class="fa-solid fa-house-user"></i> {{$item->nama_tps}}
                    </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fa-solid fa-location-dot"></i> {{ $item->alamat_tps }}
                    </h5>
                    <hr>
                    <canvas id="myChart_{{ $item->id }}" class="mb-4"></canvas>
                    <div class="card shadow p-3">
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ round(Check::presentasePemenangan($item)) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ Check::presentasePemenangan($item) }}%;"> 
                            {{ round(Check::presentasePemenangan($item)) }}%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <i class="fas fa-volume-down"></i> Target Pemenangan
                            </div>
                            <div>
                                <span>{{ number_format(Check::targetPemenangan($item),0) }} Suara</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-user"></i> Total dukungan: </span>
                        <span>{{ $item->totalsemua_tps }} Suara</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-user-tie"></i> Total Koordinator: </span>
                        <span>{{ Check::countUsersTps($item->users_id) }}</span>
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