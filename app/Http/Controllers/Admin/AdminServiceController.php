<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Antrian;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use App\Models\SuratPengantar;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UpdateStatusPengajuanRequest;
use ZipArchive;

class AdminServiceController extends Controller
{
    // Antrian
    public function antrian()
    {
        $antrian = Antrian::where('created_at', 'like', date('Y-m-d') . '%')
            ->orderBy('created_at', 'asc')->take(20)->get();

        return view('admin.layanan.antrian.index', compact('antrian'));
    }

    // Pengajuan
    public function pengajuan()
    {
        $pengajuan = SuratPengantar::orderBy('created_at', 'desc')
            ->orderBy('status_pengajuan', 'asc')->paginate(20);

        return view('admin.layanan.pengajuan.index', compact('pengajuan'));
    }

    public function pengajuanDetail($id)
    {
        $pengajuan = SuratPengantar::findOrFail($id);

        return view('admin.layanan.pengajuan.show', compact('pengajuan'));
    }

    public function pengajuanUpdate(UpdateStatusPengajuanRequest $request, $id)
    {
        $data = $request->validated();
        
        $pengajuan = SuratPengantar::findOrFail($id);
        $pengajuan->update($data);

        switch ($pengajuan->status_pengajuan) {
            case SuratPengantar::STATUS_APPROVED:
                $status = 'Verifikasi Berhasil';
                break;

            case SuratPengantar::STATUS_REJECTED:
                $status = 'Verifikasi Gagal';
                break;

            case SuratPengantar::STATUS_DONE:
                $status = 'Selesai';
                break;
            default:
                $status = 'Menunggu Verifikasi';
                break;
        }

        Notifikasi::create([
            'user_id' => $pengajuan->user_id,
            'status_notifikasi' => Notifikasi::STATUS_UNREAD,
            'judul_notifikasi' => 'Status pengajuan ' . $status,
            'isi_notifikasi' => 'Status pengajuan ' . $status . ', silahkan cek detail pengajuan anda',
            'link_notifikasi' => $pengajuan->id,
            'tipe_notifikasi' => Notifikasi::TYPE_PENGAJUAN
        ]);

        return redirect()->route('admin.pengajuan.index')->with('success', 'Status pengajuan berhasil diubah!');
    }

    public function downloadPengajuanFile($id)
    {
        $pengajuan = SuratPengantar::findOrFail($id);
    
        $files = $pengajuan->files;
    
        // Jika hanya ada satu file, langsung unduh
        if ($files->count() === 1) {
            $file = $files->first();
            $file_path = storage_path('app/' . $file->file_berkas);
            $original_name = $file->original_name;
    
            if (file_exists($file_path)) {
                return response()->download($file_path, $original_name);
            } else {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }
        }
    
        // Jika ada lebih dari satu file, buat file ZIP
        $zip = new ZipArchive;
        $zipFileName = 'pengajuan_files_' . time() . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
    
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $file_path = storage_path('app/' . $file->file_berkas);
    
                if (file_exists($file_path)) {
                    $zip->addFile($file_path, $file->original_name);
                } else {
                    $zip->close(); // Close the zip before returning an error
                    return redirect()->back()->with('error', 'One or more files are missing.');
                }
            }
            $zip->close();
    
            // Unduh file ZIP
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'Could not create ZIP file.');
        }
    }
    


    // Pengaduan
    public function pengaduan()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.layanan.pengaduan.index', compact('pengaduan'));
    }

    public function pengaduanDetail($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('admin.layanan.pengaduan.show', compact('pengaduan'));
    }
}
