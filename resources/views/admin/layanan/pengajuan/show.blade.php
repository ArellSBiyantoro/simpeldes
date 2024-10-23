@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat | Desa Gonoharjo')

@section('page-title', 'Pengajuan Surat')

@section('location', 'Admin')

@section('location-title', 'Pengajuan Surat')

@section('content')

<style>
    .file-item {
        text-align: center;
        display: inline-block; /* Make items inline to align them horizontally */
        width: 150px; /* Set a specific width for each file item */
        vertical-align: top; /* Ensure text stays aligned with image */
        margin: 10px;
    }

    .file-icon {
        display: block;
        margin: 0 auto;
        height: 100px; /* Adjust height for smaller icons */
        object-fit: cover;
    }

    .file-name {
        margin-top: 5px;
        word-wrap: break-word;
        width: 100px; /* Match width to the icon */
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap; /* Prevent text wrapping */
    }
</style>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pengajuan Surat</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.desa.update', $pengajuan->id) }}">

                        <div class="form-group">
                            <label for="nik" class="mb-3">NIK</label>
                            <input type="text" class="form-control rounded-lg" id="nik" name="nik" value="{{ $pengajuan->user->nik }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name" class="mb-3">Nama</label>
                            <input type="text" class="form-control rounded-lg" id="name" name="name" value="{{ $pengajuan->user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="mb-3">Tanggal Pengajuan</label>
                            <input type="date" class="form-control form-control-lg rounded-pill text-md" id="tanggal" name="tanggal" value="{{ $pengajuan->created_at->format('Y-m-d') }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="layanan" class="mb-3">Jenis Layanan</label>
                            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="layanan" name="layanan" value="{{ $pengajuan->jenisPelayanan->nama_pelayanan }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jenis_berkas" class="mb-3">Jenis Berkas Pendukung</label>
                            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="jenis_berkas" name="jenis_berkas" value="{{ $pengajuan->jenis_berkas == 1 ? 'Kartu Keluarga' : 'KTP/SIM/Kartu Pelajar' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="file_berkas" class="mb-3">File Pendukung</label>
                            <div class="w-100 px-4 py-3 d-flex"
                                 style="background-color: #e9ecef; border: 1px solid #ced4da; border-radius: 15px;">
                                <div class="container">
                                    @if ($pengajuan->files->count() >= 3)
                                    <div class="row">
                                        @foreach ($pengajuan->files as $index => $file)
                                        <div class="col-md-4 mb-3 file-item" data-file-url="{{ Storage::url($file->file_berkas) }}" data-file-name="{{ $file->original_name }}">
                                            @if (pathinfo($file->file_berkas, PATHINFO_EXTENSION) == 'pdf')
                                                <img class="file-icon" src="{{ asset('img/pdf.png') }}" alt="PDF Icon">
                                            @else
                                                <img class="file-icon" src="{{ Storage::url($file->file_berkas) }}" alt="{{ $file->original_name }}">
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
                                            <img class="file-icon" src="{{ asset('img/pdf.png') }}" alt="PDF Icon">
                                        @else
                                            <img class="file-icon" src="{{ Storage::url($file->file_berkas) }}" alt="{{ $file->original_name }}">
                                        @endif
                                        <p class="file-name">{{ $file->original_name }}</p>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('pengajuan.download', $pengajuan->id) }}"
                               class="btn btn-primary btn-green-pastel px-5 py-2 rounded-pill">
                                Download File
                            </a>
                        </div>

                        <div class="form-group">
                            <label for="status" class="mb-3">Status Pengajuan</label>
                            <input type="text" class="form-control form-control-lg rounded-pill text-md" id="status" name="status"
                                   value="@if ($pengajuan->status_pengajuan == 1) Menunggu Verifikasi @elseif($pengajuan->status_pengajuan == 2) Verifikasi Berhasil @elseif($pengajuan->status_pengajuan == 3) Verifikasi Gagal @else Selesai @endif" readonly>
                        </div>

                        <div class="d-flex w-100 justify-content-end mt-4">
                            <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary rounded-pill mr-2">Kembali</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal for Image Preview -->
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

@push('scripts')
<script>
    $(document).ready(function() {
        // On file item click
        $('.file-item').click(function(e) {
            e.preventDefault();

            // Get file URL and name
            var fileUrl = $(this).data('file-url');
            var fileName = $(this).data('file-name');

            // Set the modal content
            $('#imagepreview').attr('src', fileUrl);
            $('#modalOpenBtn').attr('href', fileUrl);
            $('#imagemodal .modal-title').text(fileName);

            // Show the modal
            $('#imagemodal').modal('show');
        });
    });
</script>
@endpush
