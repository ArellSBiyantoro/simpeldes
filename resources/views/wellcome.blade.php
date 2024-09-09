@extends('layouts.guest')

@section('content')
    @include('layouts.navbar')

    <div class="w-screen h-screen my-5">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-7 col-12 d-flex">
                    <div class="row align-self-center">
                        <h1 class="text-bold" style="font-size: 50px;">
                            SELAMAT DATANG DI LAYANAN <br /> DESA GONOHARJO
                        </h1>
                        <p>
                            Membantu warga Gonoharjo dalam urusan administratif, menyampaikan aspirasi, hingga kelompok tani dengan pemantauan Automatic Irigation System
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <img src="{{ asset('img/benner_kg.png') }}" alt="Banner Desa" class="w-100">
                </div>
            </div>
        </div>
    </div>
    
    <div class="w-screen py-5" style="background-color: #F6F6F6" id="profile">
        <h3 class="px-5 text-bold">Visi & Misi</h3>
        <div class="container my-5 px-5">
            <div class="visi d-flex flex-column align-items-center justify-content-center">
                <h3 class="d-inline-block text-center text-bold border-bottom-green">VISI</h3>
                <p class="text-lg text-center my-4">
                    Visi adalah suatu gambaran yang menantang tentang keadaan masa depan yang diinginkan 
                    dengan melihat potensi dan kebutuhan desa. Penyusunan Visi Desa Gonoharjo ini dilakukan 
                    dengan pendekatan partisipatif, melibatkan pihak-pihak yang berkepentingan di Desa 
                    Gonoharjo seperti pemerintah desa, BPD, tokoh masyarakat, tokoh agama, lembaga 
                    masyarakat desa dan masyarakat desa pada umumnya. Pertimbangan kondisi eksternal di 
                    desa seperti satuan kerja wilayah pembangunan di Kecamatan. Maka berdasarkan 
                    pertimbangan di atas Visi Desa Gonoharjo adalah  :
                    <br><br>
                    <strong>“ TERWUJUDNYA DESA GONOHARJO KECAMATAN LIMBANGAN YANG MANDIRI, INOVATIF  DAN BERBASIS TEKNOLOGI INFORMASI “</strong>
                </p>
                </p>
            </div>
            <div class="misi d-flex flex-column align-items-center justify-content-center">
                <h3 class="d-inline-block text-center text-bold border-bottom-green mt-4">MISI</h3>
                <ol class="text-lg my-4">
                <p>
                    Misi adalah langkah-langkah yang akan dilakukan guna mewujudkan visi. Sehingga guna 
                    mewujudkan visi Desa Gonoharjo, maka telah ditetapkan misi-misi yang memuat sesuatu 
                    pernyataan yang harus dilaksanakan oleh desa agar tercapainya visi desa tersebut. 
                    Pernyataan visi kemudian dijabarkan ke dalam misi agar dapat di operasionalkan/dikerjakan. 
                    Sebagaimana penyusunan visi, misipun dalam penyusunannya menggunakan pendekatan 
                    partisipatif dan pertimbangan potensi dan kebutuhan Desa Gonoharjo sebagaimana 
                    proses yang dilakukan, maka misi Desa Gonoharjo adalah:
                </p>
                    <li>Pengembangan Usaha Mikro Kecil dan Menangah berbasis potensi desa.</li>
                    <li>Peningkatan akses kelembagaan ekonomi lokal untuk menumbuhkan peronomian masyarakat.</li>
                    <li>Membangun lembaga pengelola dan pengembang ekonomi desa.</li>
                    <li>Membangun organisasi Usaha Ekonomi Desa dengan pelibatan kelembagaan kemasyarakatan desa.</li>
                    <li>Pengembangan ekonomi kelompok yang mandiri dan berkembang berbasis Teknologi.</li>
                    <li>Pengembangan kerjasama dengan akademisi, investor dan dunia usaha lainnya.</li>
                    <li>Menciptakan produk unggulan desa yang kreatif, inovatif dan berdaya saing.</li>
                    <li>Membuat regulasi desa sebagai jaminan keberlanjutan kegiatan usaha ekonomi.</li>
                    <li>Meningkatkan sarana dan prasarana desa penunjang perekonomian masyarakat berbasis Teknologi dan Informasi.</li>
                    <li>Mewujudkan masyarakat desa yang kreatif dan inovatif guna menghadapi globalisasi melalui Teknologi dan Informasi.</li>
                    <li>Pembinaan umat dibidang religius untuk mencapai peningkatan keimanan dan ketahanan masyarakat melalui Teknologi Informasi.</li>
                    <li>Meningkatkan kualitas sumber daya manusia, khususnya pada bidang penguasaan Teknologi dan Informasi.</li>
                    <li>Meningkatkan pelayanan masyarakat yang prima, cepat dan berbasis Teknologi dan Informasi.</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="w-screen py-5 bg-green-pastel text-white" id="kontak">
        <h3 class="px-5 text-bold">Kontak</h3>
        <div class="w-50 d-flex flex-column justify-content-center align-items-center mx-auto text-md">
            <p class="text-center my-3">Untuk informasi lebih lanjut terkait pelayanan Desa Gonoharjo <br> dapat menghubungi kontak dibawah ini :</p>
            <p><i class="fa fa-phone-alt"></i> : 081326644354</p>
            <p><i class="fa fa-envelope"></i> : anjarsetiawan41@gmail.com</p>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-green-pastel {
            background-color: #51839C;
        }
    </style>
@endpush
