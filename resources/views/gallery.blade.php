@extends('layouts.main')

@section('content')
    <div class="container p-3">
        <h2 class="mb-3">This is Gallery</h2>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="height: 300px;">
                @foreach ($photos as $key => $laporanFoto)
                    @php
                        $randomPositionX = mt_rand(0, 100); // Randomize X position between 0% and 100%
                        $randomPositionY = mt_rand(0, 100); // Randomize Y position between 0% and 100%
                    @endphp
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/images/' . $laporanFoto->foto) }}" class="d-block w-100" alt="Laporan Foto"
                            style="object-position: {{ $randomPositionX }}% {{ $randomPositionY }}%; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="my-5 w-100"></div>

        <div class="row row-cols-auto row-gap-3">
            @forelse ($photos as $item)
                <div class="col">
                    <img src="{{ asset('storage/images/' . $item->foto) }}" alt="no image" style="max-width: 250px;">
                </div>
            @empty
                <div class="col">
                    Empty!
                </div>
            @endforelse
        </div>


    </div>
@endsection
