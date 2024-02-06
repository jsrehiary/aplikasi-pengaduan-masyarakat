@extends('layouts.main')

@section('content')
    <div class="row min-vh-100 d-flex justify-content-center align-items-center">
        
        <div class="col">
            <div class="result bg-secondary p-3 rounded">
                @if ($result)
                    <h2>Hasil Pencarian</h2>
                    <table class="table table-striped-columns ">
                        <tr>
                            <th>ID Laporan</th>
                            <td>{{ $result->id_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Laporan</th>
                            <td>{{ $result->nama_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $result->category->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Laporan</th>
                            <td>{{ $result->nama_laporan }}</td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td>{{ $result->detail }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $result->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                <img src="/storage/images/{{ $result->foto }}" alt="no image :(" style="max-width: 250px;">
                            </td>
                        <tr>
                            <th>Status</th>
                            <td>
                                @switch($result->status)
                                    @case(null)
                                        <b class="text-secondary">Pending</b>
                                        @break
                                    @case("P")
                                        <b class="text-warning">Proses</b>
                                        @break
                                    @case("S")
                                        <b class="text-success">Selesai</b>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                        <tr>
                            <th>Umpan Balik</th>
                            <td>
                                {!! $result->umpan_balik ?? '<b class="text-secondary">-</b>' !!}
                            </td>
                        </tr>
                    </table>
                @else
                    <div class="alert alert-danger">
                        Data tidak ditemukan
                    </div>
                @endif
                <a href="/#cari" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@endsection
