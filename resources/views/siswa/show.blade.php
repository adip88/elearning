@extends('layouts.dashboard')

@section('title')
    Detail Siswa
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('detail_siswa_title', $siswa)}}      
@endsection

@section('content')
  <!-- content -->
  <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-body">
                 <!-- thumbnail:true -->
                 <center><img class="img-fluid"  src="{{ asset('img/'.$siswa->image)}}" alt="">
                 <!-- thumbnail:false -->
                 <!-- title -->
                 
                 <table class="table table-bordered col-md-8">
                    <tbody>
                        <tr>
                            <th>NIS</th>
                            <td>{{$siswa->nis}}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{$siswa->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td> {{$siswa->user->email}}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td> {{$siswa->jenis_kelamin}}</td>
                        </tr>
                        <tr>
                            <th>Tahun Masuk</th>
                            <td> {{$siswa->tahun_masuk}}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td> {{$siswa->agama}}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td> {{$siswa->kelas->kelas}} {{$siswa->kelas->nama_kelas}}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td> {{$siswa->no_hp}}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td> {{$siswa->alamat}}</td>
                        </tr>
                        <tr>
                            <th>Tempat/tanggal Lahir</th>
                            <td> {{$siswa->tempat_lahir}}/{{$siswa->tgl_lahir}}</td>
                        </tr>
                    </tbody>
                </table>
            </center> 
                 <div class="d-flex justify-content-end">
                    <a href="{{route('siswa.index')}}" class="btn btn-primary mx-1" role="button">
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