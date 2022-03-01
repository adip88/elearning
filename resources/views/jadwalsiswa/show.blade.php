@extends('layouts.dashboard')

@section('title')
    Detail Jadwal
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('detail_jadwal2')}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
             </div>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <table  class="table  col-md-4">
                   @foreach ($lihatjadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 
                      <tr>
                          <th>Hari</th>
                          @foreach ($detail as $item1)
                          <td>{{$item1->hari}}</td>
                          @endforeach
                      </tr>
                      <tr>
                          <th>Jam</th>
                          @foreach ($detail as $item1)
                          <td>{{$item1->jam_mulai.' - '.$item1->jam_selesai}}</td>
                          @endforeach
                      </tr>
                
                
                <tr>
                    <th>Mapel</th>
                    <td>{{$item->studi}}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{$item->kelas.' '.$item->nama_kelas}}</td>
                </tr>
                <tr>
                  
                </tr>
                 </label>
               @endforeach
                 
              
              </table>
              
            
              
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <table class="table">
                    <thead>
                      <tr align="center">
                        <th scope="col" colspan="3"><h4>Materi</h4></th>
                      </th>
                    </tr>
                </thead>
              @foreach ($materi as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    <td >{{$item->judul}}</td>
                    @if ($item->konten==!null)
                    <td>
                      <a href="{{route('download',['materi'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                        <i>Download </i>
                    </a>
                    </td>
                    @endif
                    @if ($item->link==!null)
                    <td>
                      <a href="{{$item->link}}" class="btn btn-sm btn-info" role="button">
                        <i>{{$item->link}}</i>
                    </a>
                    </td>
                    @endif
                    @if ($item->deskripsi==!null)
                    <td>
                      <<tr>
                        <td>
                          =>{{$item->deskripsi}}
                        </td>
                      </tr>
                    </td>
                    @endif
                    
                 </label>
               @endforeach
                </ul>
                  </table>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <table class="table">
                    <thead>
                      <tr align="center">
                        <th scope="col" colspan="2"><h4>Tugas</h4></th>
                      </th>
                      <tr>
                        <td align="center"><h5>Tugas</h3></td>
                        <td align="right"><h5>Action</h3></td>
                      </th>
                    </tr>
                </thead>
              @foreach ($tugas as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                  <td align="center"><h5>{{$item->judul}}</h5></td>
                    <td align="center"><div class="">
                      <a href="{{route('tugassiswa.show',['tugassiswa'=>$item->id])}}" class="btn btn-primary float-right" role="button">
                        Upload
                      </a>
             </div></td>
                 </tr>
                 <tr>
                  <td colspan="2" align="right"><b>batas waktu input tugas =>{{$item->tgl_terakhir}}</b></td>
                </tr>
                 </label>
               @endforeach
               
              @foreach ($tugasselesai as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                  <td align="center"><h5>{{$item->judul}}</h5></td>
                    <td align="center">{{$item->jawaban->nilai}}</td>
                 </tr>
                 <tr>
                   <td colspan="2"><b>tugas sudah tidak aktif</b></td>
                 </tr>
                 </label>
               @endforeach
               
                </ul>
                  </table>
              </div>
                  
            </ul>
         </div>
       </td>
       </div>
    </div>
 </div>
 
@endsection

@push('javascript-internal')
    <script>
    </script>
@endpush