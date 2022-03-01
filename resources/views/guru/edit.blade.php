@extends('layouts.dashboard')

@section('title')
    Edit Guru
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('edit_guru_title',$guru)}}
@endsection

@section('content')
<div class="row">
   <div class="col-md-12">
      <form action="{{route('guru.update',['guru'=>$guru])}}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" autofocus required value="{{old('name',$guru->name)}}">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" autofocus required value="{{old('no_hp',$guru->no_hp)}}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="{{old('jenis_kelamin',$guru->jenis_kelamin)}}">{{old('jenis_kelamin',$guru->jenis_kelamin)}}</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" id="" class="form-control @error('agama') is-invalid @enderror">
                            <option value="{{old('agama',$guru->agama)}}">{{old('agama',$guru->agama)}}</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Kristen Katolik">Kristen Katolik</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" required >{{old('alamat',$guru->alamat)}}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email',$guru->user->email)}}">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birthday">Tanggal Lahir</label>
                        <input type="date" id="birthday" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{old('tgl_lahir',$guru->tgl_lahir)}}">
                        @error('tgl_lahir')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" required value="{{old('tempat_lahir',$guru->tempat_lahir)}}">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" >
                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning px-4" href="{{route('guru.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary px-4">
                                 Save
                        </button>
                     </div>     
               </div>
                                    
                  
           
               
            </div>
         </div>
      </form>
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