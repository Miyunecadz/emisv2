@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-8 row justify-content-center ">
            <div class="col-md-5 mb-0 ms-lg-4 p-4 ">
                    {!! DNS2D::getBarcodeHTML($employee->employeenumber, 'QRCODE') !!}
            </div>
            <div class="col-md-7 text-center">
                <h2>{{$employee->fullname()}}</h2>
            </div>
        </div>
    </div>

@endsection
