@extends('frontend/layout/main')
@section('content')
<section class="py-5 bg-light">
    <div class="container px-5">
        <div class="row gx-5">
            <div class="col-xl-8">
                <h2 class="fw-bolder fs-5 mb-4">Most Views</h2>
                @foreach($mostViews as $mv)
                    <div class="mb-4">
                        @if($mv->kategori) <!-- Periksa jika kategori ada -->
                        <div class="small text-muted">{{$mv->kategori->nama_kategori}}</div>
                        @endif
                        <a class="link-dark" href="{{route('home.detailBerita',$mv->id_berita)}}"><h3>{{$mv->judul_berita}}</h3></a>
                    </div>
                @endforeach


                <div class="text-end mb-5 mb-xl-0">
                    <a class="text-decoration-none" href="{{route('home.berita')}}">
                        More news
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card border-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="text-center">
                                <div class="h6 fw-bolder">Contact</div>
                                <p class="text-muted mb-4">
                                    For press inquiries, email us at
                                    <br />
                                    <a href="#!">press@domain.com</a>
                                </p>
                                <div class="h6 fw-bolder">Follow us</div>
                                <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog preview section-->
<section class="py-5">
    <div class="container px-5">
        <h2 class="fw-bolder fs-5 mb-4">Berita Terbaru</h2>
        <div class="row gx-5">
            @foreach($berita as $row)
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="{{route('storage', $row->gambar_berita)}}" alt="{{$row->judul_berita}}" />
                        <div class="card-body p-4">
                            @if($row->kategori) <!-- Periksa jika kategori ada -->
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$row->kategori->nama_kategori}}</div>
                            @endif
                            <a class="text-decoration-none link-dark stretched-link" href="{{route('home.detailBerita',$row->id_berita)}}">
                                <div class="h5 card-title mb-3">
                                    {{$row->judul_berita}}
                                </div>
                            </a>
                            <p class="card-text mb-0">{!! substr($row->isi_berita, 0, 200) !!}...</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="small">
                                        <div class="fw-bold">Admin</div>
                                        <div class="text-muted">{{$row->created_at}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="text-end mb-5 mb-xl-0">
            <a class="text-decoration-none" href="{{route('home.berita')}}">
                More stories
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endsection
