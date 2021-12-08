@extends('layouts.app')

@section('content')

    <div class="row justify-content-center ">
        <div id="scannerArea" class="col-md-5 p-4 card mx-auto shadow rounded">
            <h5 class="text-center">Qr Code Scanner</h5>
            <div style="display:hidden;" id="reader"></div>
            @csrf
            <input type="text" name="scanRoute" id="scanRoute" value="{{route('attedance.scan')}}" hidden>
            <button class="mt-2 btn btn-success" onclick="scanQr()" id="scanBTN">Scan</button>
            <button class="mt-2 btn btn-danger text-white" onclick="stopQr()" id="stopBTN" style="display: none">Stop</button>
        </div>
    </div>

    {{-- <div class="card mb-4">
        <div class="card-header">
            {{ __('Dashboard') }}
        </div>
        <div class="card-body">

        </div> --}}
    {{-- </div> --}}

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    function scanQr(){
        stopBTN.style.display = "block";
        scanBTN.style.display = "none";
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                var cameraId = devices[0].id;
                html5QrCode.start(cameraId,{fps: 10, qrbox:{width: (scannerArea.offsetWidth - 80), height: 200}},(decodedText, decodedResult) => {
                    SendData(decodedText)
                    stopQr()
                }).catch((err) => {
                    console.error('Error found: '+err)
                });
            }
        }).catch(err => {
            console.log("Error found: "+ err)
        });
    }

    function stopQr(){
        scanBTN.style.display = "block";
        stopBTN.style.display = "none";
        html5QrCode.stop()
        if(document.getElementById('qr-shaded-region')){
            document.getElementById('qr-shaded-region').style.display = "none"
        }
    }

    async function SendData(qrcode)
    {
        let response = await fetch(scanRoute.value, {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'post',
            body: JSON.stringify({"_token": document.getElementsByName('_token')[0].defaultValue, "qrcode" : qrcode})
        })

        response = await response.json()

        if(response.saved == true)
        {
            Swal.fire({
                icon: 'success',
                title: response.data,
                showConfirmButton: false,
                timer: 5000
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: response.error,
                showConfirmButton: false,
                timer: 5000
            })
        }
    }
</script>
@endsection
