<div class="row">
    @foreach ($data as $item)
    <div class="col-lg-3">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>
                        {{$item->nama_tps}}
                    </span>
                    <span>
                        Kelurahan: {{ $item->villages->name }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>
                        Alamat: {{ $item->alamat_tps }} <br>
                        Total: {{ $item->totalsemua_tps }} Suara<br>
                    </p>
                    <footer>
                        <canvas id="myChart_{{$item->id}}" style="width: 100%; height: 300px;"></canvas>
                        <hr>
                        <cite title="Source Title" class="w-100 py-2">
                            <i class="fa-solid fa-user-tie"></i>
                            {{ Check::getUsersId($item->users_id) }}
                        </cite>
                    </footer>
                </blockquote>
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