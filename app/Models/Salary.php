<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
        'periode',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
