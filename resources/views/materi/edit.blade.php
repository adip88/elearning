@extends('layouts.dashboard')

@section('title')
    Edit Materi
@endsection

@section('breadcrumbs')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('materi.update',['materi'=>$materi])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- title -->
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">judul</label>
                    <input name="judul" id="" cols="30" rows="10" class="form-control @error('judul') is-invalid @enderror" required value="{{old('judul',$materi->judul)}}">
                    @error('judul')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Link Materi</label>
                    <input name="link" id="" cols="30" rows="10" class="form-control @error('link') is-invalid @enderror" value="{{old('link',$materi->link)}}">
                    @error('link')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Deskripsi</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control @error('deskripsi') is-invalid @enderror" >{{old('deskripsi',$materi->deskripsi)}}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Jadwal</label>
                    <select name="jadwal" id="" class="form-control @error('kelas') is-invalid @enderror">  
                        @foreach ($jadwal as $item)
                        <option value="{{$item->matkulkelas_id}}" {{old('matkulkelas_id',$materi->matkulkelas_id)==$item->id ? 'selected':null}}>{{$item->matkulkelas->kelas->kelas}} {{$item->matkulkelas->kelas->nama_kelas}} {{$item->matkulkelas->studi->studi}}</option>
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
                	<a class="btn btn-danger px-4" href="{{route('materi.index')}}">Back</a>
                	<button type="submit" class="btn btn-primary px-4">Save</button>
                </div>
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