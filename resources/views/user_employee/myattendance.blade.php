@extends('layouts.employeeapp')

@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <div class="">
        <h4>{{ __('My Attendances') }}</h4>
    </div>
    <div class="card row mb-4">

        <div class="card-body table-responsive">

            <table id='dTable' class="table table-hover ">
                <thead>
                <tr>
                    <th scope="col">Employee Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->employee->employeenumber }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->time }}</td>
                            <td>{{ $attendance->prettyStatus() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <script defer>
        $(document).ready( function () {
            $('#dTable').DataTable();
        } );
    </script>
@endsection
