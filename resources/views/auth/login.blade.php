@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="row min-h-screen align-items-center justify-content-center">
        <div class="col-lg-7 col-md-8 col-12 order-md-1 order-2">
            <div class="container">
                <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                    <a href="{{ route('wellcome') }}" class="pointer-event">
                        <img src="{{ asset('img/kg.png') }}" alt="Logo" class="img-md">
                    </a>
                    <h1 class="text-center">Login</h1>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.user') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nik" class="mb-3">NIK</label>
                        <input type="text" class="form-control rounded-pill py-3 px-3 @if ($errors->has('nik')) is-invalid @endif" id="nik" name="nik" value="{{ old('nik') }}" autofocus
                            placeholder="Masukkan NIK anda yang telah terdaftar!" data-inputmask='"mask": "9999999999999999"' data-mask>
                        @if ($errors->has('nik'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nik') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group position-relative">
                        <label for="password" class="mb-3">Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control rounded-pill py-3 px-3 @if ($errors->has('password')) is-invalid @endif" id="password" name="password"
                                placeholder="Gunakan tanggal lahir sebagai password 'tanpa menggunakan spasi dan - '">
                            <div class="position-absolute right-midlle">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <p class="text-center">Belum punya akun? <a href="{{ route('register.user') }}">Daftar</a></p>
                    </div>

                    <div class="d-flex w-100 justify-content-center mt-4">
                        <a href="{{ route('wellcome') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill mr-2">Halaman Utama</a>
                        <button type="submit" class="btn btn-primary btn-green-pastel px-4 py-2 rounded-pill">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 order-md-2 order-1 text-center mb-4 mb-md-0">
            <img src="{{ asset('img/banner-login.webp') }}" alt="logo" class="img-fluid">
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .right-midlle {
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 9999;
        }

        .btn-green-pastel {
            background-color: #51839C;
            border-color: #51839C;
            color: #fff;
        }

        .btn-green-pastel:hover {
            background-color: #3B6C81;
            border-color: #3B6C81;
            color: #fff;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }

            .img-md {
                width: 80px;
                height: auto;
            }

            h1 {
                font-size: 1.75rem;
            }

            .col-lg-4 {
                display: none;
            }

            .form-group {
                margin-bottom: 1.2rem;
            }

            .btn-outline-secondary,
            .btn-green-pastel {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .mb-md-5 {
                margin-bottom: 1.5rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>
@endpush
