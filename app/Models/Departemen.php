<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $fillable = ['nama_departemen'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Position::class);
    }

}
