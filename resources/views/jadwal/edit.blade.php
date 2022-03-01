@extends('layouts.dashboard')

@section('title')
    Edit Jadwal
@endsection

        @section('breadcrumbs')
            {{Breadcrumbs::render('edit_jadwal_title',$jadwal)}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('jadwal.update',['jadwal'=>$jadwal])}}" method="POST">
                @method('PUT')
                @csrf
                <!-- title -->
                <input type="hidden" name="kelas" value="{{$jadwal1->kelas_id}}">
                <div class="form-group">
                    <label for="input_name" class="font-weight-bold">Mapel</label>
                <select name="mapelkelas" id="" class="form-control @error('kelas') is-invalid @enderror">
                    @foreach ($matkulkelas as $item)
                        
                        <option value="{{$item->id}}" {{old('jadwal_id',$jadwal->matkulkelas_id)==$item->id ? 'selected':null}}>{{$item->studi->studi}}</option>
                    
                    @endforeach
                </select>
                @error('kelas_studi')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
                <div class="form-group">
                    <label for="input_kelas" class="font-weight-bold">
                      Jam Mulai
                    </label>
                    <div class="form-group">
                        <select name="jam_mulai" id="" class="form-control @error('jam_mulai') is-invalid @enderror">
                            <option value="{{old('jam_mulai',$jadwal->jam_mulai)}}">{{old('jam_mulai',$jadwal->jam_mulai)}}</option>
                            <option value="07:15:00">07:15:00</option>
                            <option value="07:55:00">07:55:00</option>
                            <option value="08:35:00">08:35:00</option>
                            <option value="09:15:00">09:15:00</option>
                            <option value="09:1=55:00">09:55:00</option>
                            <option value="10:15:00">10:15:00</option>
                            <option value="10:55:00">10:55:00</option>
                            <option value="11:35:00">11:35:00</option>
                            <option value="11:35:00">12:55:00</option>
                        </select>
                        @error('jam_mulai')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <label for="input_kelas" class="font-weight-bold">
                        Jam Selesai
                      </label>
                    <div class="form-group">
                        <select name="jam_selesai" id="" class="form-control @error('jam_selesai') is-invalid @enderror">
                            <option value="{{old('jam_selesai',$jadwal->jam_selesai)}}">{{old('jam_selesai',$jadwal->jam_selesai)}}</option>
                            <option value="07:55:00">07:55:00</option>
                            <option value="08:35:00">08:35:00</option>
                            <option value="09:15:00">09:15:00</option>
                            <option value="09:55:00">09:55:00</option>
                            <option value="10:15:00">10:15:00</option>
                            <option value="10:55:00">10:55:00</option>
                            <option value="11:35:00">11:35:00</option>
                            <option value="12:15:00">12:15:00</option>
                            <option value="12:55:00">12:55:00</option>
                        </select>
                        @error('jam_selesai')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                 </div>
                 <div class="form-group">
                    <label>Hari</label>
                    <select name="hari" id="" class="form-control @error('hari') is-invalid @enderror">
                        <option value="{{old('hari',$jadwal->hari)}}">{{old('hari',$jadwal->hari)}}</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('jadwal.show',['jadwal'=>$jadwal1->kelas_id])}}">Back</a>
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