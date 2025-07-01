<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $table = 'anak'; // Ganti jika nama tabel Anda berbeda (misal: 'anak_anak')

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'anak_NIK';

    // Mengindikasikan bahwa primary key bukan integer yang auto-increment
    // Karena 'anak_NIK' adalah string (VARCHAR)
    public $incrementing = false;

    // Menentukan tipe data primary key
    protected $keyType = 'string';

    // Atribut yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'anak_NIK',
        'user_nik', // Untuk mengaitkan dengan NIK user yang login
        'name',
        'tanggalLahir',
        'jenisKelamin',
        'usia',
    ];

    // Casting atribut ke tipe data tertentu
    protected $casts = [
        'tanggalLahir' => 'date', // Mengonversi ke objek Carbon
        'jenisKelamin' => 'integer', // Mengonversi 0/1 ke integer
        'usia' => 'integer',         // Mengonversi 0/1 ke integer
    ];

    // Relasi ke model UserWeb
    // Jika Anda ingin mengambil data user terkait dari data anak
    public function userWeb()
    {
        // 'UserWeb::class' adalah model user
        // 'user_nik' adalah foreign key di tabel 'anak'
        // 'nik' adalah kolom yang direferensikan di tabel 'user_webs'
        return $this->belongsTo(UserWeb::class, 'user_nik', 'nik');
    }
    /**
     * Dapatkan semua hasil self-checking untuk anak ini.
     * Menggunakan 'anak_nik' sebagai foreign key di tabel 'self_checking_results' dan 'anak_NIK' sebagai local key di 'anak'.
     */
    public function selfCheckingResults()
    {
        return $this->hasMany(SelfCheckingResult::class, 'anak_nik', 'anak_NIK');
    }

    /**
     * Hitung usia anak dalam bulan dari tanggal lahir.
     */
    public function getAgeInMonthsAttribute()
    {
        if ($this->tanggalLahir) { // Gunakan 'tanggalLahir' sesuai skema Anda
            return now()->diffInMonths($this->tanggalLahir);
        }
        return null;
    }
}
