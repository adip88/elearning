@extends('layouts.dashboard')

@section('title')
    Upload
@endsection

@section('breadcrumbs')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('materi.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- title -->
                <div class="form-group">
                    <input type="file" name="konten" class="form-control @error('konten') is-invalid @enderror">
                    @error('konten')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('lihatjadwal.index')}}">Back</a>
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