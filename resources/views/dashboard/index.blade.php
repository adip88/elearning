@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_home') }}
@endsection

@section('content')
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-header">
                <div class="row">
                    <h4 class="">Selamat Datang Admin</h4>
                 </div>
              </div>
              <div class="card-body row">
                <div class="col-md-3">
                    <h4 class="">{{$guru}}</h4>
                    <h5 class=""><a href="">Guru</a></h5>
                </div>
                <div class="col-md-3">
                    <h4 class="">{{$siswa}}</h4>
                    <h5 class=""><a href="">Siswa</a></h5>
                </div>
                <div class="col-md-3">
                    <h4 class="">{{$studi}}</h4>
                    <h5 class=""><a href="">Mapel</a></h5>
                </div>
                <div class="col-md-3">
                    <h4 class="">{{$kelas}}</h4>
                    <h5 class=""><a href="">Kelas</a></h5>
                </div>
              </div>
              <div class="card-footer">
                
              </div>
           </div>
        </div>
     </div>
@endsection