<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserWeb; 
use App\Models\Anak;

class SelfCheckingResult extends Model
{
    use HasFactory;

    protected $table = 'self_checking_results';

    protected $fillable = [
        'user_id',
        'anak_nik', // Ini adalah foreign key di tabel ini
        'child_age_months',
        'milestone_results',
        'overall_status',
    ];

    protected $casts = [
        'milestone_results' => 'array',
    ];

    /**
     * Dapatkan user_webs yang memiliki hasil self-checking ini.
     * Menggunakan 'user_id' sebagai foreign key di tabel 'self_checking_results' dan 'id' sebagai local key di 'user_webs'.
     */
    public function userWebs()
    {
        return $this->belongsTo(UserWeb::class, 'user_id', 'id');
    }

    /**
     * Dapatkan anak yang hasil self-checking ini terkait dengannya.
     * Menggunakan 'anak_nik' sebagai foreign key di tabel 'self_checking_results' dan 'anak_NIK' sebagai local key di 'anak'.
     */
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_nik', 'anak_NIK');
    }
}