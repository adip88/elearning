@extends('layouts.dashboard')

@section('title')
    Detail Guru
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('detail_guru_title', $guru)}}      
@endsection

@section('content')
<!-- content -->
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <!-- thumbnail:true -->
             <center><img class="img-fluid"  src="{{ asset('img/'.$guru->image)}}" alt="">
             <!-- thumbnail:false -->
             <!-- title -->
             
             <table class="table table-bordered col-md-8">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td>{{$guru->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td> {{$guru->user->email}}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td> {{$guru->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <th>Tahun Masuk</th>
                        <td> {{$guru->tahun_masuk}}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td> {{$guru->agama}}</td>
                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td> {{$guru->no_hp}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td> {{$guru->alamat}}</td>
                    </tr>
                    <tr>
                        <th>Tempat/tanggal Lahir</th>
                        <td> {{$guru->tempat_lahir}}/{{$guru->tgl_lahir}}</td>
                    </tr> 
                </tbody>
            </table>
        </center> 
             <div class="d-flex justify-content-end">
                <a href="{{route('guru.index')}}" class="btn btn-primary mx-1" role="button">
                   Back
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