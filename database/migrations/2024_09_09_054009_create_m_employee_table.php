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
            $table->integer('id')->autoIncrement();
            $table->primary('id');
            $table->string('nama_karyawan', 250)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 100)->nullable();
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->integer('create_by');
            $table->foreign('create_by')->references('id')->on('users');
            $table->timestamp('create_date');
            $table->integer('update_by')->nullable();
            $table->foreign('update_by')->references('id')->on('users');
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
