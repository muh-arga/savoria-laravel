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
        Schema::create('m_employee', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan', 250)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 100)->nullable();
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->foreignId('create_by')->constrained('users');
            $table->timestamp('create_date');
            $table->foreignId('update_by')->nullable()->constrained('users');
            $table->timestamp('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_employee');
    }
};
