@php
use Carbon\Carbon;

@endphp
<div class="row">
    @foreach ($gallery as $item)
    <div class="col-4">

        <!-- blog item 1 starts -->
        <div class="dtr-blog-item">
            <!-- image -->
            <div class="dtr-post-img"> <img src="{{ asset('upload/gallery/'.$item->gambar_gallery) }}" alt="{{$item->gambar_gallery}}" class="dtr-rounded" style="height: 250px;"> </div>
            <p class="text-size-sm font-weight-500 color-blue"> <span class="dtr-date">
                    {{ Carbon::parse($item->waktu_gallery)->format('d F Y H:i') }}
                </span><span class="dtr-author dtr-ml-20"></span></p>
            <h5><a href="#">{{ $item->judul_gallery }}</a></h5>
            <p class="dtr-mb-20">{{ $item->keterangan_gallery }}</p>
        </div>
        <!-- blog item 1 ends -->
    </div>

    @endforeach
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-end">
            {!! $gallery->links() !!}
        </div>
    </div>
</div>