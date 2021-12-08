@extends('layouts.app')

@section('content')
    <div class="">
        <h4>{{ __('Users') }}</h4>
    </div>
    <div class="card mb-4 row">

        <div class="col-lg-5 mt-3">
            <form action="{{ route('users.index') }}" method="get" class="d-flex gap-2">
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Keyword...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        @if ($message = Session::get('success'))
            <div class="m-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                </div>
            </div>
        @endif


        <div class="card-body table-responsive">

            <table class="table table-hover ">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->fullName() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->prettyRole() }}</td>
                            <td class="d-flex ">
                                <div class="m-1 p-1">
                                    <a class="text-warning" href="#" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="height:26px" width="16" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                          </svg>
                                    </a>
                                </div>
                                <form action="{{route('users.destroy', $user)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-link text-danger" onclick="return confirm('Are you sure?')" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="height:26px" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg>
                                    </button>
                                </form>

                                <form action="{{route('users.reset', $user)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-link text-success" onclick="return confirm('Password will be reset, confirm?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="height:26px" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                            <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

<script>

</script>
@endsection
