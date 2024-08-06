<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Antrian;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use App\Models\SuratPengantar;
use App\Models\JenisPelayanan;

use Illuminate\Http\Request;
use App\Http\Requests\User\Antrian\StoreAntrianRequest;
use App\Http\Requests\User\Pengajuan\StorePengajuanRequest;
use App\Models\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage; // Add this for file storage access
use ZipArchive;

class ServiceController extends Controller
{
    // Antrian
    public function antrian()
    {
        $pelayanan = JenisPelayanan::where('tipe_layanan', JenisPelayanan::TipeLayananAntrian)
            ->orWhere('tipe_layanan', null)->get();
        $jumlah_antrian = Antrian::where('created_at', 'like', date('Y-m-d') . '%')->count() + 1;

        return view('users.service.antrian.antrian', compact('pelayanan', 'jumlah_antrian'));
    }

    public function antrianDetail($id)
    {
        $antrian = Antrian::findOrFail($id);

        // Cek jika antrian milik user
        if ($antrian->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.user');
        }

        // Update status notifikasi
        if (request('is_read') == 2) {
            Notifikasi::where('link_notifikasi', $id)->update(['status_notifikasi' => Notifikasi::STATUS_READ]);
        }

        return view('users.service.antrian.antrian-detail', compact('antrian'));
    }

    public function antrianStore(StoreAntrianRequest $request)
    {
        $data = $request->validated();

        // Cek apakah sudah penuh
        $jumlah_antrian = Antrian::where('created_at', 'like', date('Y-m-d') . '%')->count();
        $data['no_antrian'] = $jumlah_antrian + 1;

        if ($jumlah_antrian >= 20) {
            return redirect()->back()->with('error', 'Antrian semua pelayanan sudah penuh, silahkan coba lagi besok');
        }

        $antrian = Antrian::create($data);
        Notifikasi::create([
            'user_id' => $data['user_id'],
            'status_notifikasi' => Notifikasi::STATUS_UNREAD,
            'judul_notifikasi' => 'Antrian berhasil dibuat',
            'isi_notifikasi' => 'Antrian anda berhasil dibuat, silahkan menunggu panggilan selanjutnya',
            'link_notifikasi' => $antrian->id,
            'tipe_notifikasi' => Notifikasi::TYPE_ANTRIAN
        ]);

        return redirect()->route('antrian.detail', $antrian->id);
    }

    // Pengajuan
    public function pengajuan()
    {
        $pelayanan = JenisPelayanan::where('tipe_layanan', JenisPelayanan::TipeLayananPengajuan)
            ->orWhere('tipe_layanan', null)->get();

        return view('users.service.pengajuan.pengajuan', compact('pelayanan'));
    }

    public function pengajuanDetail($id)
    {
        $pengajuan = SuratPengantar::findOrFail($id);

        // Cek jika pengajuan milik user
        if ($pengajuan->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.user');
        }

        // Update status notifikasi
        if (request('is_read') == 2) {
            Notifikasi::where('link_notifikasi', $id)->update(['status_notifikasi' => Notifikasi::STATUS_READ]);
        }

        return view('users.service.pengajuan.pengajuan-detail', compact('pengajuan'));
    }

    public function pengajuanStore(StorePengajuanRequest $request)
    {
        $data = $request->validated();
        $data = Arr::except($data, ['file_berkas']);
        $pengajuan = SuratPengantar::create($data);

        if ($request->hasFile('file_berkas')) {
            foreach ($request->file('file_berkas') as $file) {
                $fileName = $file->store('public/uploads/pengajuan');
                $originalName = $file->getClientOriginalName();

                File::create([
                    'surat_pengantar_id' => $pengajuan->id,
                    'file_berkas' => $fileName,
                    'original_name' => $originalName,
                ]);
            }
        }

        Notifikasi::create([
            'user_id' => $data['user_id'],
            'status_notifikasi' => Notifikasi::STATUS_UNREAD,
            'judul_notifikasi' => 'Pengajuan berhasil dibuat',
            'isi_notifikasi' => 'Pengajuan anda berhasil dibuat, silahkan menunggu proses selanjutnya',
            'link_notifikasi' => $pengajuan->id,
            'tipe_notifikasi' => Notifikasi::TYPE_PENGAJUAN
        ]);

        return redirect()->route('pengajuan.detail', $pengajuan->id);
    }

    // Add this method for downloading file pengajuan
    public function pengajuanDownload($id)
    {
        $pengajuan = SuratPengantar::findOrFail($id);

        // Cek jika pengajuan milik user
        if ($pengajuan->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.user');
        }

        // Get file path
        $file_path = storage_path('storage/app/public/uploads/pengajuan' . $pengajuan->file_berkas);

        // Check if file exists
        if (!file_exists($file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        // Download file
        return response()->download($file_path, $pengajuan->orginal_name_berkas);
    }


    // Pengaduan
    public function pengaduan()
    {
        return view('users.service.pengaduan.pengaduan');
    }

    public function pengaduanDetail($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // Update status notifikasi
        if (request('is_read') == 2) {
            Notifikasi::where('link_notifikasi', $id)->update(['status_notifikasi' => Notifikasi::STATUS_READ]);
        }

        return view('users.service.pengaduan.pengaduan-detail', compact('pengaduan'));
    }

    public function pengaduanStore(Request $request)
    {
        $request->validate(
            [
                'isi_pengaduan' => 'required|string',
            ],
            [
                'isi_pengaduan.required' => 'Isi pengaduan tidak boleh kosong',
                'isi_pengaduan.string' => 'Isi pengaduan harus berupa string',
            ]
        );

        $data = $request->all();

        $pengaduan = Pengaduan::create($data);

        Notifikasi::create([
            'user_id' => auth()->user()->id,
            'status_notifikasi' => Notifikasi::STATUS_UNREAD,
            'judul_notifikasi' => 'Pengaduan berhasil dibuat',
            'isi_notifikasi' => 'Pengaduan anda berhasil dibuat, silahkan menunggu proses selanjutnya',
            'link_notifikasi' => $pengaduan->id,
            'tipe_notifikasi' => Notifikasi::TYPE_PENGADUAN
        ]);

        return redirect()->route('pengaduan.detail', $pengaduan->id);
    }
}
