@extends('layouts.auth')


@section('content')
<div><center>
    <img src="logoti.png" alt="" height="60%" width="60%">

</center>
</div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
       <label class="small mb-1" for="input_login_email">Email</label>
       <input name="email" class="form-control py-4 @error('email') is-invalid @enderror" id="input_login_email" type="email" placeholder="Enter email address" value="{{ old('email') }}" required autocomplete="email"/>
       @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
       <label class="small mb-1" for="input_login_password">Password</label>
       <input name="password" class="form-control py-4 @error('email') is-invalid @enderror" id="input_login_password" type="password" placeholder="Enter password" value="{{ old('password') }}" required autocomplete="password" />
       @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
       <button class="btn btn-primary px-4" type="submit">Login</button>
    </div>
 </form>
@endsection