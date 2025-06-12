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
        Schema::create('anak', function (Blueprint $table) {
            $table->id('anakId');
            $table->string('name');
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin',['Laki-laki','Perempuan']);
            $table->float('tinggi');
            $table->float('berat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
