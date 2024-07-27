<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_pengantar_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_pengantar_id');
            $table->string('file_path');
            $table->string('original_name');
            $table->timestamps();

            $table->foreign('surat_pengantar_id')->references('id')->on('surat_pengantar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar_files');
    }
};
