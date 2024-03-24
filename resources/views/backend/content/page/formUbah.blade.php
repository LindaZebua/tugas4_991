@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800" > From Ubah Page</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('page.prosesUbah')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Pake</label>
                        <input type="text" name="judul_page" value="{{$page->judul_page}}" class="form-control @error('judul_page') is-invalid @enderror">
                        @error('judul_page')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea id="editor" name="isi_page" class="form-control @error('isi_page') is-invalid @enderror">{{$page->isi_page}}</textarea>
                        @error('isi_page')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Status Page</label>
                        @php
                            $aktif ="";
                            $tidakAktif ="";
                            if (($page->status_page ==1)){
                                $aktif = "selected";
                            }else{
                                $tidakAktif = "selected";
                            }
                        @endphp
                        <select class="form-control  @error('status_page') is-invalid @enderror" name="status_page">
                            <option value="1"{{$aktif}}>Aktif</option>
                            <option value="0"{{$tidakAktif}}>Tidak Aktif</option>
                        </select>
                        @error('status_page')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="id_page" value="{{$page->id_page}}">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{route('page.index')}}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
