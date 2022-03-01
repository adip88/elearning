@extends('layouts.dashboard')

@section('title')
    Jadwal Pelajaran Tahun {{$thajar->tahun}}
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('jadwal2')}}
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
             </div>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th>Hari</th>
                         <th>Jam</th>
                         <th>Mapel</th>
                         <th>Kelas</th>
                         @if ($th->id==$thajar->id)
                         <th>Action</th>
                         @endif
                        
                     </tr>
                 </thead>
               @if (count($jadwal))
                   @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Senin')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                         
                    @endif
                 </tr>
                
                 </label>
               @endforeach

               @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Selasa')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                    @endif
                 </tr>
                
                 </label>
               @endforeach
               @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Rabu')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                    @endif
                 </tr>
                
                 </label>
               @endforeach
               @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Kamis')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                    @endif
                 </tr>
                
                 </label>
               @endforeach
               @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Jumat')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                    @endif
                 </tr>
                
                 </label>
               @endforeach
               @foreach ($jadwal as $item)
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 <tr>
                    @if ($item->hari=='Sabtu')
                        <td>{{$item->hari}}</td>
                        <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                        <td>{{$item->studi}}</td>
                        <td>{{$item->kelas.' '.$item->nama_kelas}}</td> 
                        @if ($th->id==$thajar->id)
                        <td><a href="{{route('lihatjadwal.show',['lihatjadwal'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                          <i>Daftar Siswa</i>
                      </a></td> 
                        @endif
                    @endif
                 </tr>
                
                 </label>
               @endforeach

               @else
                   tidak ada jadwal ajar di semester ini
               @endif
               
              </table>
            </ul>
         </div>
         <div class="card-footer">
         </div> 

       </div>
    </div>
 </div>
 
@endsection

@push('javascript-internal')
    <script>
    </script>
@endpush