@extends('layouts.dashboard')

@section('title')
    Edit Siswa
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('edit_siswa_title',$siswa)}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('siswa.update',['siswa'=>$siswa])}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!-- title -->
                <div class="form-group">
                    <label>Nis</label>
                    <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" autofocus required value="{{old('nis',$siswa->nis)}}">
                    @error('nis')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

               <div class="form-group">
                  <label>Nama Siswa</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" autofocus required value="{{old('name',$siswa->name)}}">
                  @error('name')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>No Hp</label>
                  <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" autofocus required value="{{old('no_hp',$siswa->no_hp)}}">
                  @error('no_hp')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                      <option value="{{old('jenis_kelamin',$siswa->jenis_kelamin)}}">{{old('jenis_kelamin',$siswa->jenis_kelamin)}}</option>
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
                      <option value="{{old('agama',$siswa->agama)}}">{{old('agama',$siswa->agama)}}</option>
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
                  <textarea name="alamat" id="" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" required >{{old('alamat',$siswa->alamat)}}</textarea>
                  @error('alamat')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email',$siswa->user->email)}}">
                  @error('email')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="input_name" class="font-weight-bold">Kelas</label>
                  <select name="kelas" id="" class="form-control @error('kelas') is-invalid @enderror">
                      <option value="">--Pilih Kelas--</option>
                      @foreach ($kelas as $item)
                          <option value="{{$item->id}}" {{old('kelas_id',$siswa->kelas_id)==$item->id ? 'selected':null}}>{{$item->kelas}} {{$item->nama_kelas}}</option>
                      @endforeach
                  </select>
                  @error('kelas')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label for="birthday">Tanggal Lahir</label>
                <input type="date" id="birthday" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{old('tgl_lahir',$siswa->tgl_lahir)}}">
                @error('tgl_lahir')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" required value="{{old('tempat_lahir',$siswa->tempat_lahir)}}">
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
              <div class="form-group">
                  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                  @error('image')
                  <div class="invalid-feedback">{{$message}}</div>
              @enderror
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('siswa.index')}}">Back</a>
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