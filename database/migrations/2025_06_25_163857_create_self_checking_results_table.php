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
        Schema::create('self_checking_results', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel hasil self-checking ini
            
            // Foreign key ke tabel 'user_webs' melalui kolom 'id'
            // Ini sesuai dengan bagaimana Auth::id() bekerja (mengembalikan integer ID dari user yang login)
            $table->foreignId('user_id')->constrained('user_webs')->onDelete('cascade');
            // Foreign key ke tabel 'anak' melalui kolom 'anak_NIK'
            // Karena 'anak_NIK' adalah primary key string di tabel 'anak', kita definisikannya secara eksplisit
            $table->string('anak_nik')->comment('Foreign key to anak.anak_NIK');
            $table->foreign('anak_nik')->references('anak_NIK')->on('anak')->onDelete('cascade');
            $table->float('child_age_months'); // Usia anak saat pengecekan (dalam bulan)
            $table->json('milestone_results'); // Simpan semua hasil milestone detail dalam bentuk JSON
            $table->string('overall_status', 20); // 'good', 'warning', 'danger'
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_checking_results');
    }
};
