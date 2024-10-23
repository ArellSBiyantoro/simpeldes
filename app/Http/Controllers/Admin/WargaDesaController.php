<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Admin\UpdateWargaDesaRequest;

class WargaDesaController extends Controller
{
    public function index()
    {
        $warga_desa = User::where('user_type', User::USER_TYPE_USER)
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.warga-desa.index', compact('warga_desa'));
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        // Menghapus tanda "-" dari nomor telepon
        $data['phone_number'] = str_replace('-', '', $data['phone_number']);
        
        // Set user type ke User (bukan Admin)
        $data['user_type'] = User::USER_TYPE_USER;

        // Mengatur password berdasarkan tanggal lahir (format: ddmmyyyy)
        $password = Carbon::parse($data['tanggal_lahir'])->format('dmY');
        $data['password'] = Hash::make($password);

        // Set default nilai untuk is_kelompok_tani jika tidak diisi
        if (!isset($data['is_kelompok_tani'])) {
            $data['is_kelompok_tani'] = 'Tidak';
        }

        // Membuat pengguna baru
        User::create($data);

        return redirect()->route('warga.desa.index')->with('success', 'Berhasil menambahkan data warga desa');
    }

    public function show($id)
    {
        $warga_desa = User::findOrFail($id);

        return view('admin.warga-desa.show', compact('warga_desa'));
    }

    public function edit($id)
    {
        $warga_desa = User::findOrFail($id);

        return view('admin.warga-desa.edit', compact('warga_desa'));
    }

    public function update(UpdateWargaDesaRequest $request, $id)
    {
        $data = $request->validated();
    
        $warga_desa = User::findOrFail($id);
    
        // Menghapus tanda "-" dari nomor telepon
        $data['phone_number'] = str_replace('-', '', $data['phone_number']);
    
        // Mengatur ulang password berdasarkan tanggal lahir (format: ddmmyyyy)
        $password = Carbon::parse($data['tanggal_lahir'])->format('dmY');
        $data['password'] = Hash::make($password);
    
        // Set nilai is_kelompok_tani sesuai input form (Ya/Tidak)
        $data['is_kelompok_tani'] = $request->input('is_kelompok_tani', 'Tidak');
    
        // Memperbarui data warga desa
        $warga_desa->update($data);
    
        return redirect()->route('warga.desa.index')->with('success', 'Berhasil mengubah data warga desa');
    }
    

    public function destroy($id)
    {
        $warga_desa = User::findOrFail($id);

        $warga_desa->delete();

        return redirect()->route('warga.desa.index')->with('success', 'Berhasil menghapus data warga desa');
    }
}
