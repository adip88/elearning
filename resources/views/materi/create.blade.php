@extends('layouts.dashboard')

@section('title')
    Add Materi
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
                   <label for="input_kelas" class="font-weight-bold">
                      Judul
                   </label>
                   <input id="judul" value="{{old('judul')}}" name="judul" type="text" class="form-control @error('judul') is-invalid @enderror" placeholder="enter"/>
                   @error('judul')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Link Materi</label>
                    <input name="link" id="" cols="30" rows="10" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}">
                    @error('link')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror" >{{old('deskripsi')}}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Kelas</label>
                    <select name="jadwal" id="" class="form-control @error('kelas') is-invalid @enderror">
                        @foreach ($jadwal as $item)
                        <option value="{{$item->id}}" {{old('jadwal_id')==$item->id ? 'selected':null}}>{{$item->kelas}} {{$item->nama_kelas}} {{$item->studi}}</option>
                        @endforeach
                    </select>
                    @error('jadwal')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
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