@extends('layouts.dashboard')

@section('title')
    Profil
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('profil')}}
@endsection

@section('content')
<!-- content -->
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <!-- thumbnail:true -->
             <center>
             @if (Auth::user()->level=="guru" or Auth::user()->level=="siswa") 
               <img class="img-fluid"  src="{{ asset('img/'.$user->image)}}" alt="">
             @endif
             <!-- thumbnail:false -->
             <!-- title -->
             
             <table class="table table-bordered col-md-8">
                <tbody>
                    @if (Auth::user()->level=="siswa" or Auth::user()->level=="guru") 
                    <tr>
                        <th>Nama</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Status</th>
                        <td> {{$user->level}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td> {{$user->email}}</td>
                    </tr>
                    @if (Auth::user()->level=="siswa" or Auth::user()->level=="guru") 
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td> {{$user->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <th>Tahun Masuk</th>
                        <td> {{$user->tahun_masuk}}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td> {{$user->agama}}</td>
                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td> {{$user->no_hp}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td> {{$user->alamat}}</td>
                    </tr>
                    <tr>
                        <th>Tempat/tanggal Lahir</th>
                        <td> {{$user->tempat_lahir}}/{{$user->tgl_lahir}}</td>
                    </tr> 
                    @endif
                </tbody>
               
            </table>
        </center> 
             <div class="d-flex justify-content-end">
                <a href="{{route('profil.edit',['profil'=>$user->id])}}" class="btn btn-primary mx-1" role="button">
                   Edit Profil
                </a>
                <a href="{{route('profil.create')}}" class="btn btn-primary mx-1" role="button">
                    change password
                 </a>
             </div> 
          </div>
       </div>
    </div>
 </div>

@endsection

@push('css-internal')
        <!-- style -->
    <style>
        .category-tumbnail {
        width: 100%;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    </style>
@endpush