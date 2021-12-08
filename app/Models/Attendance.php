<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'time',
        'status'
    ];

    private static $status = [
        'in' => 'IN',
        'out' => 'OUT'
    ];


    public static $IN = 'in';
    public static $OUT = 'out';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function prettyStatus()
    {
        return self::$status[$this->status];
    }

}
