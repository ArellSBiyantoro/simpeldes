@extends('layouts.app')

@section('title', 'Admin Desa | Desa Gonoharjo')

@section('page-title', 'Admin Desa')

@section('location', 'Admin')

@section('location-title', 'Admin Desa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card card-primary collapsed-card w-100">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Informasi Desa</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('informasi.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama" class="mb-3">Nama</label>
                                <input type="text" class="form-control rounded-lg @if ($errors->has('nama')) is-invalid @endif" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                                @if ($errors->has('nama'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="jabatan" class="mb-3">Jabatan</label>
                                <input type="text" class="form-control rounded-lg @if ($errors->has('jabatan')) is-invalid @endif" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan Jabatan">
                                @if ($errors->has('jabatan'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jabatan') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email" class="mb-3">Email</label>
                                <input type="email" class="form-control rounded-lg @if ($errors->has('email')) is-invalid @endif" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control rounded-lg @if ($errors->has('foto')) is-invalid @endif" id="foto" name="foto">
                                @if ($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex w-100 justify-content-end mt-5">
                                <button type="submit" class="btn btn-primary btn-green-pastel px-5 py-2">Tambah</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">List Informasi Desa</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($informasi as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if($item->foto)
                                                    <img src="{{ asset('img/' . $item->foto) }}" alt="{{ $item->nama }}" style="width: 100px; height: 100px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img/default.jpg') }}" alt="default" style="width: 100px; height: 100px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('informasi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('informasi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('informasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $informasi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
