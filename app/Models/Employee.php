<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departemen;
use App\Models\Position;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'departemen_id',
        'jabatan_id',
        'tanggal_masuk',
        'status'
    ];
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    // App\Models\Employee.php
    // Employee.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

}
