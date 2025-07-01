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
        if (Schema::hasTable('anak')) {
            Schema::drop('anak');
        }
        Schema::create('anak', function (Blueprint $table) {
                $table->string('anak_NIK')->primary();
                $table->string('user_nik')->nullable();
                $table->string('name');
                $table->date('tanggalLahir');
                $table->enum('jenisKelamin',[0,1]);
                $table->enum('usia',[0,1]);
                $table->timestamps();
                $table->foreign('user_nik')
                  ->references('nik')
                  ->on('user_webs')
                  ->onDelete('cascade');
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
