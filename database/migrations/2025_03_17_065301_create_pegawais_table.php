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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tempat_bekerja');
            $table->foreign('id_tempat_bekerja')->references('id')->on('tempat_bekerja')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id')->on('jabatans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_golongan');
            $table->foreign('id_golongan')->references('id')->on('golongans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->date('tanggal_lahir');
            $table->enum('gender',['pria','wanita']);
            $table->string('foto')->nullable();
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
