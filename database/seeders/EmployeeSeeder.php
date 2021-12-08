<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'qrcode' => '12345',
            'employeenumber' => '123',
            'firstname' => 'June Vic',
            'lastname' => 'Cadayona',
            'middlename' => 'Wales',
            'email' => 'jvcadz@gmail.com',
            'position' => 'parttime',
            'username' => 'admin',
            'password' => Hash::make(12345678)
        ]);
    }
}
