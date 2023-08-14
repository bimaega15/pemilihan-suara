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
                        Alamat: {{ $item->alamat_tps }}
                    </p>
                    <footer>
                        <span class="blockquote-footer">
                            <i class="fas fa-users"></i> Total Dukungan: {{ $item->totalsemua_tps }}
                        </span>
                        <br>
                        <span class="blockquote-footer">
                            <i class="fas fa-calendar-minus"></i> Minimal Dukungan: {{ $item->minimal_tps }}
                        </span>
                        <br>
                        <span class="blockquote-footer">
                            <i class="fas fa-flag"></i> Target Dukungan: {{ $item->pendukung_tps }}
                        </span>
                        <br>
                        <hr>
                        <cite title="Source Title" class="w-100 py-2">
                            <i class="fas fa-user-tie"></i> {{ Check::getUsersId($item->users_id) }}
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