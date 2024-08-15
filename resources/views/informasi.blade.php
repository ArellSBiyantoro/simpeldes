@extends('layouts.guest')

@section('title', '| Under Maintenance')
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
            gap: 20px;
            justify-content: left;
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

        <h1 
            style="
            font-weight: bold; 
            font-size: 36px;
            ">
            Susunan Organisasi Pengurus Desa
        </h1>

        <div class="grid">
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Kepala Desa">
                <h2>Nama Kepala Desa</h2>
                <p>Jabatan: Kepala Desa</p>
                <p>Email: Kepaladesa@gmail.com</p>
            </div>
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Sekertaris Desa">
                <h2>Nama Sekertaris Desa</h2>
                <p>Jabatan: Sekertaris Desa</p>
                <p>Email: Sekertarisdesa@gmail.com</p>
            </div>
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Bendahara Desa">
                <h2>Nama Bendahara Desa</h2>
                <p>Jabatan: Bendahara Desa</p>
                <p>Email: Bendaharadesa@gmail.com</p>
            </div>
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Humas Desa">
                <h2>Nama Humas Desa</h2>
                <p>Jabatan: Humas Desa</p>
                <p>Email: Humasdesa@gmail.com</p>
            </div>
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Pembanguan Desa">
                <h2>Nama Pembanguan Desa</h2>
                <p>Jabatan: Pembanguan Desa</p>
                <p>Email: Pembangunandesa@gmail.com</p>
            </div>
            <div class="card">
                <img src="{{ asset('img/profile.jpg') }}" alt="Keryawan Desa">
                <h2>Nama Keryawan Desa</h2>
                <p>Jabatan: Keryawan Desa</p>
                <p>Email: Keryawandesa@gmail.com</p>
            </div>
        </div>
    </div>
@endsection
