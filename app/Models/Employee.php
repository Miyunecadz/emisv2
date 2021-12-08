<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

use function PHPSTORM_META\map;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable =[
        'qrcode',
        'employeenumber',
        'firstname',
        'lastname',
        'middlename',
        'suffix',
        'email',
        'position',
        'username',
        'password'
    ];

    private static $positions = [
        'parttime' => 'Part-Time',
        'regular' => 'Regular',
        'jo' => 'Job Order'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function prettyPosition()
    {
        return self::$positions[$this->position];
    }

    public function fullName()
    {
        return Str::title($this->firstname.' '.$this->lastname.' '.$this->suffix);
    }

    public static function validPositions()
    {
        return self::$positions;
    }

    public static function generateQrCode($qrcode=null)
    {
        do{
            $qrcode = rand(00000001, 99999999);
        }while(Employee::isExistingQrCode($qrcode));

        return $qrcode;
    }

    public static function isExistingQrCode($qrcode)
    {
        return self::where('qrcode', $qrcode)->count() > 0;
    }

    public function getQrCode()
    {
        return Crypt::encrypt($this->qrcode);
    }

}
