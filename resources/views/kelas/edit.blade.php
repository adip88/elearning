@extends('layouts.dashboard')

@section('title')
    Edit Kelas
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('edit_kelas_title',$kela)}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('kelas.update',['kela'=>$kela])}}" method="POST">
                @method('PUT')
                @csrf
                <!-- title -->
                <div class="form-group">
                   <label for="input_studi" class="font-weight-bold">
                      Nama Kelas
                   </label>
                   <input id="input_nama_kelas" value="{{old('nama_kelas',$kela->nama_kelas)}}" name="nama_kelas" type="text" class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="enter nama_kelas"/>
                   @error('nama_kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="input_deskripsi" class="font-weight-bold">
                        Nama Kelas
                     </label>
                     <input id="input_deskripsi" value="{{old('deskripsi',$kela->deskripsi)}}" name="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="enter deskripsi"/>
                     @error('deskripsi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('kelas.index')}}">Back</a>
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