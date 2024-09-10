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
        Schema::create('m_family', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->primary('id');
            $table->integer('employee_id');
            $table->foreign('employee_id')->references('id')->on('m_employee')->onDelete('cascade');
            $table->string('hubungan_keluarga', 100)->nullable();
            $table->string('nama_anggota_keluarga', 250)->nullable();
            $table->date('tanggal_lahir_anggota_keluarga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_family');
    }
};
