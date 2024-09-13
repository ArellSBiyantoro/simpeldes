@extends('layouts.guest')

@section('title', '| Manajemen Irigrasi IOT')

    
    <style>
        .full-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(#007bff calc(var(--progress) * 1%), #d3d3d3 0%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .progress-item {
            margin: 20px auto;
            text-align: center;
        }

        .card {
            border-radius: 15px;
            padding: 20px;
            transition: 0.3s ease;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        h4.card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #495057;
        }

        .card-body {
            padding: 30px;
        }

        p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .badge {
            font-size: 1rem;
            padding: 10px 15px;
            border-radius: 10px;
        }

        .status-badge {
            margin-top: 6px;
        }
    </style>

@section('content')
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar" style="background-color: #343a40;">
            <div class="container">
                <button onclick="history.back()" class="btn btn-light">Kembali</button>
                <a class="navbar-brand" href="#" style="color: #ffffff; margin-top: 0.5 rem;">Manajemen Irigrasi IOT</a>
            </div>
        </nav>

        <!-- Main Section -->
        <div class="container mt-4">
            <h1 class="text-center mb-4" style="color: #343a40;">Manajemen Irigrasi IOT</h1>

            <!-- Sensor Data Cards -->
            <div class="row">
                <!-- Kelembapan Tanah -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h4 class="card-title">Kelembapan Tanah</h4>
                            <div class="progress-item">
                                <div class="full-circle" id="kelembapan-circle" style="--progress: 0;">
                                    <span id="kelembapan-circle-text">0%</span>
                                </div>
                            </div>
                            <p class="mt-3">Kelembapan tanah: <span id="kelembapan">-</span></p>
                        </div>
                    </div>
                </div>

                <!-- Ketinggian Air -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h4 class="card-title">Ketinggian Air</h4>
                            <div class="progress-item">
                                <div class="full-circle" id="ketinggian-circle" style="--progress: 0;">
                                    <span id="ketinggian-circle-text">0%</span>
                                </div>
                            </div>
                            <p class="mt-3">Ketinggian air: <span id="ketinggian">-</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gate Status -->
            <div class="row">
                <!-- Pintu 1 -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left">
                            <h4 class="card-title">Pintu 1</h4>
                            <span class="badge bg-blue status-badge" id="pintu1" style="margin-left: 1rem;"></span>
                        </div>
                    </div>
                </div>

                <!-- Pintu 2 -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left">
                            <h4 class="card-title">Pintu 2</h4>
                            <span class="badge bg-blue status-badge" id="pintu2" style="margin-left: 1rem;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JS File -->
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endsection
