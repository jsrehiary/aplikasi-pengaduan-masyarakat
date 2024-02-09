@extends('layouts.main')

@section('content')
    <div class="w-100 my-3"></div>

    <section id="home">
        <div class="row min-vh-100 d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="w-100 my-3"></div>

                <h2>Aplikasi Pelayanan Pengaduan dan Aspirasi Masyarakat</h2>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam perspiciatis quo sint facere inventore ad,
                    maxime iste eos aut debitis incidunt saepe id! Iusto deleniti accusamus vero, ut sed delectus.</p>
                <div class="list-group list-group-flush">
                    <a class="btn btn-lg btn-info list-group-item text-start" href="#history">History</a>
                    <a class="btn btn-lg btn-info list-group-item text-start" href="#form">Form</a>
                    <a class="btn btn-lg btn-info list-group-item text-start" href="#cari">Cari</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">

            </div>
        </div>
    </section>

    <div class="row min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col">
            <section id="history">
                <h2 class="mb-4">Histori Laporan</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal Laporan</th>
                                <th class="text-center">Laporan</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporans as $laporan)
                                <tr>
                                    <td class="text-center">{{ $laporan->created_at }}</td>
                                    <td class="text-center">{{ $laporan->nama_laporan }}</td>
                                    <td class="text-center">{{ $laporan->category->category_name }}</td>
                                    <td class="text-center" class="text-center">
                                        <img src="{{ asset('storage/images/' . $laporan->foto) }}" alt="no image :("
                                            style="max-width: 250px">
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

            </section>
        </div>
    </div>

    <div class="row min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col">
            <section id="form" class="p-5 border rounded shadow bg-secondary-subtle">
                {{-- Let's create the form from here --}}
                <H2>Form Laporan Pengaduan</H2>

                <div class="my-4 w-100 bg-success rounded" style="height: 3px;"></div>

                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="formLaporId" class="form-label">ID Laporan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="formLaporId" value="{{ $id_laporan }}"
                                    name="id_laporan" aria-explainedby="explainLaporId" readonly>
                                <button class="btn btn-success" type="button" onclick="copyLaporId()">Copy</button>
                            </div>
                            <div class="form-text" id="explainLaporId">*ID <b>dicatat</b> atau <b>disalin</b> untuk
                                pemantauan lebih lanjut.</div>
                            @error('id_laporan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 mb-3">
                            <label for="formKategori" class="form-label">Kategori</label>
                            <select name="kategori" id="formKategori" class="form-select">
                                <option selected disabled hidden>Pilih Kategori</option>
                                {{-- Select from Categories --}}
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @empty
                                    <option>No Category Found.</option>
                                @endforelse
                            </select>
                            @error('kategori')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-lg-7 mb-3">
                            <label for="formLaporan" class="form-label">Laporan</label>
                            <input type="text" class="form-control" id="formLaporan" name="laporan" required>
                        </div>
                        @error('laporan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="col mb-3">
                            <label for="formDetail" class="form-label">Detail</label>
                            <textarea class="form-control" id="formDetail" rows="3" name="detail" required></textarea>
                            @error('detail')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label for="formAlamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="formAlamat" rows="3" name="alamat" required></textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="formFoto" class="form-label">Foto Kejadian</label>
                            <input type="file" name="foto" id="formFoto" class="form-control" required>
                            @error('foto')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-3 col-12 d-flex">
                            <button class="w-100 btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>

                </form>
            </section>
        </div>
    </div>

    <div class="row min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col">
            <section id="cari" class="p-5 border rounded shadow bg-secondary-subtle">
                <h2>Pencarian Laporan</h2>

                <form action="/cari" method="GET">
                    <div class="mb-3">
                        <label for="formCari" class="form-label">Cari (by ID)</label>
                        <div class="input-group input-group-lg">
                            <input name="lapor_id" type="text" class="form-control" id="formCari" required>
                            <button class="btn btn-success">Cari</button>
                        </div>
                    </div>
                </form>

            </section>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif

        // DEBUG
        document.getElementById('formKategori').value = 2;
        document.getElementById('formLaporan').value = generateRandomString();
        document.getElementById('formDetail').value = generateRandomString();
        document.getElementById('formAlamat').value = generateRandomString();
        // DELETE IF DONE

        function generateRandomString() {
            // Generate a random alphanumeric string with a length of 10 characters
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < 10; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }


        function copyLaporId() {
            const laporId = document.getElementById('formLaporId')
            laporId.select();
            document.execCommand('copy');
            laporId.setSelectionRange(0, 0);

            alert('Disalin ke clipboard: ' + laporId.value);
        }
    </script>
@endsection
