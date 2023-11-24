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
        Schema::create('alumni', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat_lengkap');
            $table->string('pekerjaan');
            $table->float('ipk');
            $table->timestamps();
            $table->foreign('jurusan')->references('kode_jurusan')->on('majors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
