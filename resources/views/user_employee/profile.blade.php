@extends('layouts.employeeapp')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('My profile') }}
        </div>

        <form action="{{ route('employee.profileUpdate') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg></span>
                    <input class="form-control" type="text" name="firstname" placeholder="{{ __('First Name') }}"
                           value="{{ old('name', auth()->guard('employee')->user()->firstname) }}" required>
                    @error('firstname')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg></span>
                    <input class="form-control" type="text" name="lastname" placeholder="{{ __('Last Name') }}"
                           value="{{ old('name', auth()->guard('employee')->user()->lastname) }}" required>
                    @error('lastname')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                    </svg></span>
                    <input class="form-control" type="text" name="email" placeholder="{{ __('Email') }}"
                           value="{{ old('email', auth()->guard('employee')->user()->email) }}" readonly>
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg></span>
                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                           name="password" placeholder="{{ __('New password') }}" required>
                    @error('password')
                    <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg></span>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                           name="password_confirmation" placeholder="{{ __('New password confirmation') }}" required>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>

        </form>

    </div>
@endsection