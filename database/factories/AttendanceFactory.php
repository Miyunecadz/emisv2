<?php

namespace Database\Factories;

use App\Models\Employee;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employee = Employee::orderBy('created_at')->first();
        $dateTime = Carbon::now(new DateTimeZone('Asia/Singapore'));
        $dateToday = $dateTime->format('m-d-Y');
        $timeToday = $dateTime->format('H:i');
        $status = ['in', 'out'];

        return [
            'employee_id' => $employee->id,
            'date' => $dateToday,
            'time' => $timeToday,
            'status' => $status[rand(0,1)]
        ];
    }
}
