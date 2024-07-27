<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratPengantarFile extends Model
{
    use HasFactory;
    protected $table = 'surat_pengantar_Files';

    protected $fillable = ['surat_pengantar_id', 'file_path', 'original_name'];

    public function suratPengantar()
    {
        return $this->belongsTo(SuratPengantar::class);
    }
}