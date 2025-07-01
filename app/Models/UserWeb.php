<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserWeb extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = ['name','email','password','nik'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function anaks()
    {
        // 'Anak::class' adalah model anak
        // 'user_nik' adalah foreign key di tabel 'anak'
        // 'nik' adalah primary key (atau kolom yang direferensikan) di tabel 'user_webs'
        return $this->hasMany(Anak::class, 'user_nik', 'nik');
    }

    public function selfCheckingResults()
    {
        return $this->hasMany(SelfCheckingResult::class, 'user_id', 'id');
    }
}
