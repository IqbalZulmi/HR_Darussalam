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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipe_cuti',['tahunan','sakit','melahirkan','cuti besar']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status',['menunggu','diterima','ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
