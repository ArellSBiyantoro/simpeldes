@extends('layouts.guest')

@section('title', '| Dashboard')

<style>
    .container1 {
        max-width: 1200px;
        margin: 48px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .grid {
        display: flex;
        flex-wrap: wrap;
    display: ;     justify-content: center;
    }

    .border-bottom-green {
        border-bottom: 5px solid #51839C;
    }

    .h-screen {
        height: 100vh;
    }

    .backgroud-desa {
        position: relative;
        top: 0;
        z-index: 1;
    }

    .backgroud-desa::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("{{ asset('img/banner-user-dashboard.webp') }}");
        background-size: cover;
        background-position: center;
        opacity: 0.6;
        z-index: -1;
    }

    .layanan {
        width: 300px;
        height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 25px;
        gap:10px;
        text-decoration: none;
        color: #000000;
        transition: transform 0.3s ease;
    }

    .layanan:hover {
        transform: scale(1.05);
    }

    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .layanan {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            padding: 15px;
        }

        .w-100.d-flex.justify-content-around.align-items-center.mt-4  {
            flex-direction: column;
            align-items: center;
        }

        h1.text-bold.mb-4 {
            font-size: 1.5rem;
        }

        p.text-lg {
            font-size: 1rem;
        }
    }
</style>

@section('content')
    <div class="h-screen">
        @include('layouts.navbar')

        <div class="w-100 h-100 backgroud-desa">
            <div class="container h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center mb-5">
                    <h1 class="text-bold mb-4">Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}</h1>
                    <p class="text-lg">Butuh pelayanan apa hari ini?</p>
                </div>
                <div class="w-100 d-flex justify-content-around align-items-center mt-4">
                    <a class="layanan" href="{{ route('pengajuan') }}">
                        <i class="fa fa-file-alt fa-6x"></i>
                        <p class="text-lg mt-4">Pengajuan Surat Pengantar</p>
                    </a>
                    @if(auth()->user()->is_kelompok_tani == 'Ya')
                        <a class="layanan" href="{{ route('tani.index') }}">
                            <i class="fa fa-users fa-6x"></i>
                            <p class="text-lg mt-4">Manajemen Sistem Irigrasi</p>
                        </a>
                    @endif
                    <a class="layanan" href="{{ route('pengaduan') }}">
                        <i class="fa fa-chalkboard-teacher fa-6x"></i>
                        <p class="text-lg mt-4">Aduan Masyarakat Desa</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
