@extends('layouts.dashboard')

@section('title')
    Detail Matei
@endsection

@section('breadcrumbs')
       
@endsection

@section('content')
  <!-- content -->
  <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-body">
                 <!-- thumbnail:true --> 
                 <!-- thumbnail:false -->
                 <!-- title -->
                 
                 <table class="table table-bordered col-md-8">
                    <tbody>
                        <tr>
                            <th>Batas Pengumuman</th>
                            <td>{{$materi->judul}}</td>
                        </tr>
                        <tr>
                            <th>Hari</th>
                            <td>
                                @foreach ($jadwal as $item)
                                    {{$item->hari}}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>
                                @foreach ($jadwal as $item)
                                    {{$item->kelas.' '.$item->nama_kelas}}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Studi</th>
                            <td>
                                @foreach ($jadwal as $item)
                                    {{$item->studi}}
                                @endforeach
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </center> 
                 <div class="d-flex justify-content-end">
                    <a href="{{route('pengumuman.index')}}" class="btn btn-primary mx-1" role="button">
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