<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $jenisLayanan = [
            // Tipe 1
            [
                'id' => 1,
                'nama_pelayanan' => 'Surat Keterangan Kelahiran',
                'tipe_layanan' => 2
            ],
            [
                'id' => 2,
                'nama_pelayanan' => 'Surat Keterangan Kematian',
                'tipe_layanan' => 2
            ],
            [
                'id' => 3,
                'nama_pelayanan' => 'Surat Pengantar Nikah, Talak, Cerai, Rujuk (NTCR)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 4,
                'nama_pelayanan' => 'Surat Pengantar Pembuatan Dispensasi Nikah Mendadak',
                'tipe_layanan' => 2
            ],
            [
                'id' => 5,
                'nama_pelayanan' => 'Surat Pengantar Penerbitan Duplikat Surat Nikah',
                'tipe_layanan' => 2
            ],
            [
                'id' => 6,
                'nama_pelayanan' => 'Surat Keterangan Belum Menikah, Duda/Janda',
                'tipe_layanan' => 2
            ],
            [
                'id' => 7,
                'nama_pelayanan' => 'Surat Keterangan Tidak Mampu untuk Pengajuan Keringanan Biaya Sekolah/Pengajuan Beasiswa',
                'tipe_layanan' => 2
            ],
            [
                'id' => 8,
                'nama_pelayanan' => 'Surat Keterangan Wali Nikah',
                'tipe_layanan' => 2
            ],

            // tipe 2
            [
                'id' => 9,
                'nama_pelayanan' => 'Surat Pengantar pembuatan Surat Keterangan Catatan Kepolisian (SKCK)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 10,
                'nama_pelayanan' => 'Surat Pengantar Penerbitan Kartu Tanda Penduduk (KTP)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 11,
                'nama_pelayanan' => 'Surat Pengantar Penerbitan Kartu Keluarga (KK)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 12,
                'nama_pelayanan' => 'Surat Pengantar Pembuatan Surat Pindah',
                'tipe_layanan' => 2
            ],
            [
                'id' => 13,
                'nama_pelayanan' => 'Surat Keterangan Boro Kerja',
                'tipe_layanan' => 2
            ],
            [
                'id' => 14,
                'nama_pelayanan' => 'Surat Pengantar Calon Tenaga Kerja Indonesia (TKI/TKW)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 15,
                'nama_pelayanan' => 'Surat Pengantar Pengambilan Uang di Bank/Lembaga Lain',
                'tipe_layanan' => 2
            ],
            [
                'id' => 16,
                'nama_pelayanan' => 'Legalisasi Umum',
                'tipe_layanan' => 2
            ],

            // Tipe 3
            [
                'id' => 17,
                'nama_pelayanan' => 'Surat Rekomendasi Ijin Kegiatan/Keramaian',
                'tipe_layanan' => 2
            ],
            [
                'id' => 18,
                'nama_pelayanan' => 'Surat Pengantar Pembuatan Pernyataan Ahli Waris',
                'tipe_layanan' => 2
            ],
            [
                'id' => 19,
                'nama_pelayanan' => 'Surat Pengantar Pembuatan Konversi Tanah',
                'tipe_layanan' => 2
            ],
            [
                'id' => 20,
                'nama_pelayanan' => 'Pengesahan Surat Pernyataan Tidak Keberatan tetangga yang dipersyaratkan dalam penerbitan Ijin Mendirikan Bangunan (IMB)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 21,
                'nama_pelayanan' => 'Pengesahan Surat Pernyataan Tidak Keberatan tetangga yang dipersyaratkan dalam penerbitan Ijin Gangguan (HO)',
                'tipe_layanan' => 2
            ],
            [
                'id' => 22,
                'nama_pelayanan' => 'Surat Keterangan Domisili Tempat Usaha',
                'tipe_layanan' => 2
            ],

            // Lain-lain
            
            [
                'id' => 23,
                'nama_pelayanan' => 'Lain - Lain',
                'tipe_layanan' => null
            ]
        ];

        DB::table('jenis_pelayanan')->insert($jenisLayanan);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('jenis_pelayanan')->truncate();
    }
};
