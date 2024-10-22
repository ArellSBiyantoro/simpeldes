@extends('layouts.service')

@section('title', 'Detail Surat Pengantar')

@section('judul', 'Detail Pengajuan Surat Pengantar')
<style>
    .file-item {
        text-align: center;
        width: 100%; /* Memastikan lebar elemen menyesuaikan dengan kontainer */
    }
    .file-icon {
        display: block;
        margin: 0 auto; /* Memusatkan ikon */
        height: 150px; /* Sesuaikan dengan tinggi yang diinginkan */
        object-fit: cover;
    }
    .file-name {
        margin-top: 10px;
        word-wrap: break-word; /* Membungkus nama file jika terlalu panjang */
        width: 150px; /* Sesuaikan dengan lebar ikon */
        overflow: hidden;
        text-overflow: ellipsis; /* Menampilkan ellipsis jika teks terlalu panjang */
    }
</style>

@section('content')

    <div class="p-5">


        <h3 class="font-weight-bold">Data yang Anda Ajukan sudah Masuk ke dalam Sistem Kami</h3>
        <p class="mb-4">Periksa Notifikasi anda secara berkala untuk meninjau status berkas yang anda ajukan</p>

        <div class="form-group">
            <label for="nik" class="mb-3">NIK</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nik" name="nik"
                value="{{ $pengajuan->user->nik }}" placeholder="Masukkan NIK anda" readonly>
        </div>

        <div class="form-group">
            <label for="nama" class="mb-3">Nama Lengkap</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="nama" name="nama"
                value="{{ $pengajuan->user->name }}" placeholder="Masukkan nama lengkap anda" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal" class="mb-3">Tanggal Pengajuan</label>
            <input type="date" class="form-control form-control-lg rounded-pill text-md" id="tanggal" name="tanggal"
                value="{{ $pengajuan->created_at->format('Y-m-d') }}" readonly>
        </div>

        <div class="form-group">
            <label for="layanan" class="mb-3">Jenis Layanan</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="layanan" name="layanan"
                value="{{ $pengajuan->jenisPelayanan->nama_pelayanan }}" readonly>
        </div>

        <div class="form-group">
            <label for="keterangan" class="mb-3">Keterangan</label>
            <div class="form-control form-control-lg rounded-pill text-md" id="keterangan" readonly>
                {{ $pengajuan->keterangan ?? 'Tidak ada keterangan' }}
            </div>
        </div>

        <div class="form-group">
            <label for="jenis_berkas" class="mb-3">Jenis Berkas Pendukung</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="jenis_berkas"
                name="jenis_berkas" value="{{ $pengajuan->jenis_berkas == 1 ? 'Kartu Keluarga' : 'KTP/SIM/Kartu Pelajar' }}"
                readonly>
        </div>

        <div class="form-group">
            <label for="file_berkas" class="mb-3">File Pendukung</label>
            <div class="w-100 px-4 py-3 d-flex"
                style="background-color: #e9ecef; border: 1px solid #ced4da; border-radius: 15px;">
                <a href="#" id="pop">
                    <div class="container">
                        @if ($pengajuan->files->count() >= 3)
                            <div class="row">
                                @foreach ($pengajuan->files as $index => $file)
                                    <div class="col-md-4 mb-3 file-item" data-file-url="{{ Storage::url($file->file_berkas) }}" data-file-name="{{ $file->original_name }}">
                                        @if (pathinfo($file->file_berkas, PATHINFO_EXTENSION) == 'pdf')
                                            <!-- Tampilkan ikon PDF jika file adalah PDF -->
                                            <img class="file-icon" 
                                                src="{{ asset('img/pdf.png') }}" 
                                                alt="PDF Icon">
                                        @else
                                            <!-- Tampilkan gambar jika bukan PDF -->
                                            <img class="file-icon" 
                                                src="{{ Storage::url($file->file_berkas) }}"
                                                alt="{{ $file->original_name }}">
                                        @endif
                                        <p class="file-name">{{ $file->original_name }}</p>
                                    </div>
                                    @if (($index + 1) % 3 == 0 && $index + 1 != $pengajuan->files->count())
                            </div>
                            <div class="row">
                                    @endif
                                @endforeach
                            </div>
                        @else
                            @foreach ($pengajuan->files as $file)
                                <div class="col-md-4 mb-3 file-item" data-file-url="{{ Storage::url($file->file_berkas) }}" data-file-name="{{ $file->original_name }}">
                                    @if (pathinfo($file->file_berkas, PATHINFO_EXTENSION) == 'pdf')
                                        <!-- Tampilkan ikon PDF jika file adalah PDF -->
                                        <img class="file-icon" 
                                            src="{{ asset('img/pdf.png') }}" 
                                            alt="PDF Icon">
                                    @else
                                        <!-- Tampilkan gambar jika bukan PDF -->
                                        <img class="file-icon" 
                                            src="{{ Storage::url($file->file_berkas) }}"
                                            alt="{{ $file->original_name }}">
                                    @endif
                                    <p class="file-name">{{ $file->original_name }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </a>
            </div>
        </div>

        <!-- <div class="mt-3">
            <a href="{{ route('pengajuan.download', $pengajuan->id) }}"
                class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill">
                Download File
            </a>
        </div> -->
    
        <div class="form-group">
            <label for="status" class="mb-3">Status Pengajuan</label>
            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="status" name="status"
                value="@if ($pengajuan->status_pengajuan == 1) Menunggu Verifikasi @elseif($pengajuan->status_pengajuan == 2) Verifikasi Berhasil @elseif($pengajuan->status_pengajuan == 3) Verifikasi Gagal @else Selesai @endif"
                readonly>
        </div>
    
        <div class="d-flex w-100 justify-content-end mt-5">
            <a href="{{ route('dashboard.user') }}" class="btn btn-outline-secondary px-5 py-2 rounded-pill mr-3">Dashboard</a>
            <a href="{{ route('notifikasi') }}" class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill">Notifikasi</a>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="imagemodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="imagepreview" class="mx-auto" style="max-width: 100%;">
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary btn-green-pastel" id="modalOpenBtn" href="" target="_blank">Open</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .btn-green-pastel {
            background-color: #51839C !important;
            border-color: #51839C !important;
        }

        .btn-green-pastel:hover {
            background-color: #3B6E85 !important;
            border-color: #3B6E85 !important;
        }
    </style>
@endpush

@push('scripts')    
    <script>
        $(document).ready(function() {
            // Saat gambar atau file-item di klik
            $('.file-item').click(function(e) {
                e.preventDefault();

                // Ambil URL file dan nama file
                var fileUrl = $(this).data('file-url');
                var fileName = $(this).data('file-name');

                // Set gambar atau file ke dalam modal
                $('#imagepreview').attr('src', fileUrl);
                $('#modalOpenBtn').attr('href', fileUrl);
                $('#imagemodal .modal-title').text(fileName);

                // Tampilkan modal
                $('#imagemodal').modal('show');
            });
        });
    </script>

@endpush


