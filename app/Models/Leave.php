<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'type',
        'reason',
        'status',
        'approved_by',
        'attachment',
    ];

    /**
     * Relasi ke Employee (pegawai yang mengajukan izin)
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Relasi ke User (HR/Manajer yang menyetujui izin)
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope untuk izin approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk izin pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk izin rejected
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Hitung durasi izin (jumlah hari)
     */
    public function getDurationAttribute()
    {
        $end = $this->end_date ?? $this->start_date;
        return \Carbon\Carbon::parse($this->start_date)
            ->diffInDays(\Carbon\Carbon::parse($end)) + 1;
    }
}
