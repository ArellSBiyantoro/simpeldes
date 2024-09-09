<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function wellcome()
    {
        $jumlah_notifikasi = Notifikasi::where('user_id', auth()->user()->id ?? null)->where('status_notifikasi', Notifikasi::STATUS_UNREAD)->count() ?? 0;

        return view('wellcome', compact('jumlah_notifikasi'));
    }

    public function informasi()
    {
        // Fetch the count of unread notifications for the authenticated user
        $jumlah_notifikasi = Notifikasi::where('user_id', auth()->user()->id ?? null)
            ->where('status_notifikasi', Notifikasi::STATUS_UNREAD)
            ->count() ?? 0;
    
        // Fetch all data from the 'informasi' table
        $informasi = Informasi::all();
    
        // Pass both variables to the view
        return view('informasi', compact('jumlah_notifikasi', 'informasi'));
    }
}
