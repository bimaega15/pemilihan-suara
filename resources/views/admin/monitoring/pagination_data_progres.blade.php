<div class="row">
    @foreach ($data as $item)
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Animated stripes</h5>
                <p class="card-description">The striped gradient can also be animated. Add <code>.progress-bar-animated</code> to <code>.progress-bar</code> to animate the stripes right to left via CSS3 animations.</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
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