<section id="home">
    <div id="banner-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div style="width: 100%; height: 1000px; position: absolute; background-color: #000; opacity: 50%; z-index: 1;"></div>
            @foreach ($banner as $index => $item)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 1000px;">
                <img class="d-block w-100" src="{{ asset('upload/banner/'.$item->gambar_banner) }}" alt="{{ $item->gambar_banner }}">
                <div class="carousel-caption d-none d-md-block" style="top: 25%; left: 15%; text-align: left; z-index: 2;">
                    <h2 class="color-orange w-50">{{ $item->judul_banner }}</h2>
                    <p class="font-weight-bold w-50">{{ $item->keterangan_banner }}</p>
                </div>
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#banner-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="carousel-control-next" href="#banner-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Selanjutnya</span>
        </a>
    </div>

</section>