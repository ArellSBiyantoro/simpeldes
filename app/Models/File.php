<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['surat_pengantar_id', 'file_berkas', 'original_name'];

    public function suratPengantar()
    {
        return $this->belongsTo(SuratPengantar::class);
    }
}
