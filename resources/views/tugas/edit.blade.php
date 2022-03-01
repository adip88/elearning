@extends('layouts.dashboard')

@section('title')
    Edit Tugas
@endsection

@section('breadcrumbs')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('tugas.update',['tuga'=>$tuga])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- title -->
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">judul</label>
                    <input name="judul" id="" cols="30" rows="10" class="form-control @error('judul') is-invalid @enderror" required value="{{old('judul',$tuga->judul)}}" ></textarea>
                    @error('judul')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Tugas</label>
                    <textarea name="tugas" id="" cols="30" rows="10" class="form-control @error('tugas') is-invalid @enderror" required value="">{{old('tugas',$tuga->tugas)}}</textarea>
                    @error('tugas')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Jadwal</label>
                    <select name="jadwal" id="" class="form-control @error('kelas') is-invalid @enderror">  
                        @foreach ($jadwal as $item)
                        <option value="{{$item->matkulkelas_id}}" {{old('matkulkelas_id',$tuga->matkulkelas_id)==$item->id ? 'selected':null}}>{{$item->matkulkelas->kelas->kelas}} {{$item->matkulkelas->kelas->nama_kelas}} {{$item->matkulkelas->studi->studi}}</option>
                        @endforeach
                    </select>
                    @error('jadwal')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
               <div class="form-group">
                    <label>Tanggal Terakhir</label>
                    <input type="datetime-local" name="tgl_terakhir" class="form-control @error('tgl_terakhir') is-invalid @enderror" required value="{{old('tgl_terakhir',$tuga->tgl_terakhir)}}">
                    @error('tgl_terakhir')
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
                	<a class="btn btn-danger px-4" href="{{route('tugas.index')}}">Back</a>
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