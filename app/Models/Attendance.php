<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Field yang bisa diisi (mass assignment)
    protected $fillable = [
        'employee_id',
        'date',
        'clock_in',
        'clock_out',
        'status',
    ];

    /**
     * Relasi ke model Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
