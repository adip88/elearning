@extends('layouts.dashboard')

@section('title')
    Change Password
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('profil/password')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('changepassword',['profil2'=>auth()->user()->id])}}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autofocus required value="{{old('password')}}">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password2" class="form-control @error('password2') is-invalid @enderror" autofocus required value="{{old('password2')}}">
                    @error('password2')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('profil.index')}}">Back</a>
                	<button type="submit" class="btn btn-primary px-4">Save</button>
                </div>                
             </form>
          </div>
       </div>
    </div>
 </div>

@endsection

@push('css-external')
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2-bootstrap4.min.css')}}">
@endpush

@push('javascript-external')
    <script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/in.js') }}"></script>
@endpush

@push('javascript-internal')
    <script>
       
    </script>
@endpush