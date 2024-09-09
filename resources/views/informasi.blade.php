@extends('layouts.guest')

@section('title', '| Susunan Organisasi Pengurus Desa')

<style>
    .container1 {
        max-width: 1200px;
        margin: 48 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        padding-bottom: 12px;
    }
    .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px 32px;
        justify-content: center;
    }
    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 250px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        text-align: center;
        margin-bottom: 10px;
    }
    .card h2 {
        font-size: 1.2em;
        margin-bottom: 12px;
        text-align: left;
        font-weight: 600;
    }
    .card p {
        margin-bottom: 4px;
        text-align: left;
        font-size: 14px;
    }
</style>

@section('content')
    @include('layouts.navbar')

    <div class="container1">
        <h1 style="font-weight: bold; font-size: 36px; margin-bottom: 1rem;">
            Susunan Organisasi Pengurus Desa
        </h1>

        <div class="grid">
            @foreach($informasi as $info)
                <div class="card">
                    {{-- Tampilkan gambar jika ada, jika tidak tampilkan gambar default --}}
                    @if($info->foto)
                        <img src="{{ asset('img/' . $info->foto) }}" alt="{{ $info->jabatan }}">
                    @else
                        <img src="{{ asset('img/profile.jpg') }}" alt="{{ $info->jabatan }}"> {{-- Gambar default jika tidak ada --}}
                    @endif
                    <h2>{{ $info->nama }}</h2>
                    <p>Jabatan: {{ $info->jabatan }}</p>
                    <p>Email: {{ $info->email }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
