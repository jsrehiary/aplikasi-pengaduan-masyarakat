@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
    <div class="p-3">
        <div class="min-vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="col">
                    <div class="card rounded shadow border">
                        <div class="card-header py-3">
                            <h2>Administrator mode</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tanggal Laporan</th>
                                            <th class="text-center">Laporan</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Lokasi34</th>
                                            <th class="text-center">Foto</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($laporans as $laporan)
                                            <tr>
                                                <td class="text-center">{{ $laporan->created_at }}</td>
                                                <td class="text-center">{{ $laporan->nama_laporan }}</td>
                                                <td class="text-center">{{ $laporan->category->category_name }}</td>
                                                <td class="text-center">{{ $laporan->detail }}</td>
                                                <td class="text-center">{{ $laporan->alamat }}</td>
                                                <td class="text-center" class="text-center">
                                                    <img src="{{ asset('storage/images/' . $laporan->foto) }}"
                                                        alt="no image :(" style="max-width: 250px">
                                                </td>
                                                <td class="text-center">
                                                    @switch($laporan->status)
                                                        @case('P')
                                                            <b class="text-warning">Proses</b>
                                                        @break

                                                        @case('S')
                                                            <b class="text-success">Selesai</b>
                                                        @break

                                                        @default
                                                            <b class="text-secondary">Pending</b>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-info"
                                                        href="{{ route('admin.show', $laporan->id) }}"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a class="btn btn-outline-warning"
                                                        href="{{ route('admin.edit', $laporan->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin.destroy', $laporan->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            href="{{ route('admin.destroy', $laporan->id) }}"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <div class="alert alert-danger">
                                                    Belum ada laporan.
                                                </div>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        @if (session('result'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: '{{ session('result')['nama_laporan'] }}',
                    html: `
                    <div class="text-start">
                        <div class="row mb-3">
                            <div class="col">
                                Kategori: <b>{{ session('result')['category']['category_name'] }}</b>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Detail: <b>{{ session('result')['detail'] }}</b>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Alamat: <b>{{ session('result')['alamat'] }}</b>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Foto
                                <img src="{{ asset('storage/images/' . session('result')['foto']) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Dibuat: {{ session('result')['created_at'] }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Diperbarui: {{ session('result')['updated_at'] }}
                            </div>
                        </div>
                    </div>
                    `,
                });
            </script>
        @endif

        @if (Session::has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('error') }}',
                });
            </script>
        @endif
    @endsection
