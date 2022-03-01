@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
<link rel="stylesheet" href="{{asset('vendor/my-dashboard/css/dashboard.css')}}">
   <!-- fontawesome -->
   <script src="{{asset('vendor/fontawesome-free/js/all.min.js')}}"></script>
   <!-- icon flag -->
   <link rel="stylesheet" href="{{asset('vendor/flag-icon-css/css/flag-icon.min.css')}}">
   <!-- css external -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

