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
        if (Schema::hasTable('pertumbuhan')) {
            Schema::drop('pertumbuhan');
        }
        Schema::create('pertumbuhan', function (Blueprint $table) {
            $table->id('pertumbuhanId');
            $table->foreignId('anakId');
            $table->date('tanggal');
            $table->float('tinggi');
            $table->float('berat');
            $table->foreign('anakId')->references('anakId')->on('anak');
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
