@extends('layouts.guest')

@section('content')
    <div class="col-md-6">
        <div class="card mb-4 mx-4">
            <div class="card-body p-4">
                <h1>Register</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg></span>
                        <input class="form-control" type="text" name="firstname" placeholder="{{ __('Firstname') }}" required
                               autocomplete="name" autofocus>
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
                            <input class="form-control" type="text" name="lastname" placeholder="{{ __('Lastname') }}" required
                                   autocomplete="name" autofocus>
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
                            <input class="form-control" type="text" name="username" placeholder="{{ __('Username') }}" required
                                    autocomplete="username">
                            @error('username')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                    </svg></span>
                        <input class="form-control" type="text" name="email" placeholder="{{ __('Email') }}" required
                               autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                        </svg></span>
                        <select class="form-select" name="role" id="role">
                            <option value="" disabled selected>Please select</option>
                            <option value="hrmo">HRMO</option>
                            <option value="incharge">In-charge Personel</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                    </svg></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                               name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
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
                               name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                               autocomplete="new-password">
                    </div>

                    <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>

                </form>
            </div>
        </div>
    </div>

@endsection
