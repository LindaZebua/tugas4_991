@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Menu </h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{route('menu.tambah')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Tambah </a>

            </div>
        </div>
        @if(session()->has('pesan'))
            <div class="alert alert-{{session()->get('pesan')[0]}}">
                {{session()->get('pesan')[1]}}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th> Nama Menu</th>
                            <th> Status Menu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($menu as $k => $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>
                                    {{$row->nama_menu}}<br/>
                                    <ul>
                                        @foreach($row->submenu as $key => $sub)
                                            <li>
                                                {{$sub->nama_menu}}
                                                <a href="{{route('menu.ubah',$sub->id_menu)}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('menu.hapus',$sub->id_menu)}}"><i class="fa fa-trash"></i></a>

                                                <span>{{($sub->status_menu == 0) ? "()Tidak Aktif" : ""}}</span>

                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{($row->status_menu == 1) ? "aktif" : "Tidak Aktif"}}</td>

                                <td>
                                    <a href="{{route('menu.ubah',$row->id_menu)}}" class="btn btn-sm btn-secondary"><i class="fa fa-edit" ></i>Ubah</a>
                                    <a href="{{route('menu.hapus',$row->id_menu)}}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-secondary"><i class="fa fa-trash" ></i>Hapus</a>

                                    @if($loop->first)
                                        @php
                                        $nextKeyMenu = $k + 1;
                                        $nextIdMenu = $menu->get($nextKeyMenu)->id_menu;
                                        @endphp

                                        <a href="{{route('menu.order',[$row->id_menu,$nextIdMenu])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-arrow-down"></i>
                                        </a>
                                    @elseif($loop->last)
                                        @php
                                            $prevKeyMenu = $k - 1;
                                            $prevIdMenu = $menu->get($prevKeyMenu)->id_menu;
                                        @endphp

                                        <a href="{{route('menu.order',[$row->id_menu,$prevIdMenu])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-arrow-up"></i>
                                        </a>
                                    @else
                                        @php
                                            $nextKeyMenu = $k + 1;
                                            $nextIdMenu = $menu->get($nextKeyMenu)->id_menu;
                                            $prevKeyMenu = $k - 1;
                                            $prevIdMenu = $menu->get($prevKeyMenu)->id_menu;
                                        @endphp
                                        <a href="{{route('menu.order',[$row->id_menu,$prevIdMenu])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-arrow-up"></i>

                                        <a href="{{route('menu.order',[$row->id_menu,$nextIdMenu])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-arrow-down"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
