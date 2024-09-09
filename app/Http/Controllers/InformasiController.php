<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel informasi
        $informasi = Informasi::all();

        // Mengirim data ke view
        return view('informasi', compact('informasi'));
    }
}
