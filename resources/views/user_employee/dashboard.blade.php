@extends('layouts.employeeapp')

@section('content')

    <div class="row justify-content-center ">

        <div id="qrcodeArea" class="col-md-5 p-4 card mx-auto shadow rounded justify-content-center">
            <div class="alert alert-info" role="alert"><strong>Note:</strong> Qr Code can be change everytime the page reload. This event prevent from stealing of QRCODES!</div>
            <div class="d-flex">
                <div class="ms-lg-3"></div>
                @php
                    echo DNS2D::getBarcodeHTML(auth()->guard('employee')->user()->getQrCode(), 'QRCODE',4.5,5);
                @endphp

            </div>
        </div>
    </div>

@endsection
