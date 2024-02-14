@extends('layouts.admin')

@section('css')
@endsection

@section('content')
    <div class="row min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="col-md-12 border p-2 rounded">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header">
                    <h2>Edit Laporan</h2>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Judul Laporan: {{ $laporan->nama_laporan }}</li>
                        <li>Detail Laporan: {{ $laporan->detail }}</li>
                        <li>Alamat Kejadian: {{ $laporan->alamat }}</li>
                        <li>Status Penyelesaian: 
                            @switch($laporan->status)
                                @case(null)
                                    <b class="text-secondary">Pending</b>
                                    @break
                                @case('P')
                                    <b class="text-warning">Proses</b>
                                    @break
                                @case('S')
                                    <b class="text-success">Selesai</b>
                                    @break
                                @default
                                    
                            @endswitch
                        </li>
                    </ul>
                    <form action="{{ route('admin.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="formStatus" class="form-label">Status</label>
                            <select name="status" id="formStatus" class="form-select">
                                <option value="" @if($laporan->status == "") selected @endif>Pending</option>
                                <option value="P" @if($laporan->status == "P") selected @endif>Proses</option>
                                <option value="S" @if($laporan->status == "S") selected @endif>Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3"></div>

                        <div class="form-group">
                            <label class="font-weight-bold">Umpan balik</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="umpan_balik" rows="5"
                                placeholder="Masukkan Umpan Balik">{{ old('content', $laporan->content) }}</textarea>
                            <!-- error message untuk content -->
                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3"></div>

                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>

                    </form>
                </div>
                <div class="card-footer">
                    <a href="/admin">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
