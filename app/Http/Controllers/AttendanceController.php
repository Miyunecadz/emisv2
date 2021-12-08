<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        // if(!($request->dateFrom && $request->dateTo))
        // {
        //     $dateFrom = '';
        //     $dateTo = '';
        // }
        // $dateFrom = Carbon::createFromFormat('m/d/Y', $request->dateFrom)->format('m-d-Y');
        // $dateTo =  Carbon::createFromFormat('m/d/Y', $request->dateTo)->format('m-d-Y');
        // dd($dateFrom, $dateTo);
        $attendances = Attendance::paginate();

        return view('attendances.index', ['attendances' => $attendances]);
    }

    public function filterByLoginEmployee()
    {
        $attendances =  Attendance::where('employee_id', auth()->guard('employee')->user()->id)->paginate();
        return view('user_employee.myattendance', ['attendances' => $attendances]);
    }

    public function scan(Request $request)
    {
        $qrcode = Crypt::decrypt($request->qrcode);
        $dateTime = Carbon::now(new DateTimeZone('Asia/Singapore'));
        $dateToday = $dateTime->format('m-d-Y');
        $timeToday = $dateTime->format('H:i');
        $newStatus = Attendance::$IN;

        $employee = Employee::where('qrcode', $qrcode)->first();

        if(!$employee)
        {
            return response()->json(['saved' => false, 'error' => 'Employee Not Found']);
        }

        $countAttendance = Attendance::where('employee_id', $employee->id)->where('date' , $dateToday)->get()->count();

        if($countAttendance >= 4)
        {
            return response()->json(['saved' => false,'error' => 'Quota has been reached the limit, comeback tomorrow!', 'count' => $countAttendance]);
        }

        $recentAttendance = Attendance::where('employee_id', $employee->id)->where('date', $dateToday)->orderBy('id', 'desc')->first();

        if($recentAttendance  && ($recentAttendance->status === Attendance::$IN))
        {
            $newStatus = Attendance::$OUT;
        }

        $newAttendance = Attendance::create([
            'employee_id' => $employee->id,
            'date' => $dateToday,
            'time' => $timeToday,
            'status' => $newStatus
        ]);


        return response()->json(['saved' => true, 'data' => 'Attendance successfully saved!']);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return back()->with('success', 'Attendance successfully deleted!');
    }
}
