<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class Employee extends Model
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

    public function fullName()
    {
        return Str::title($this->firstname.' '.$this->lastname.' '.$this->suffix);
    }
}
