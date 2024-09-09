<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasi'; // Tabel yang digunakan
    protected $fillable = ['nama', 'jabatan', 'email', 'foto']; // Isi dengan kolom yang ada di tabel
}
