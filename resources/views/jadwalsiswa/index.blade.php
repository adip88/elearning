@extends('layouts.dashboard')

@section('title')
    Jadwal Pelajaran Tahun {{$th->tahun}}
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('jadwal2')}}
@endsection

@section('content')

<div class="card-body">
   <ul class="list-group list-group-flush">
      <!-- list category --> 
      
      <div class="card-body">
       <ul class="list-group list-group-flush">
         <table class="table table-bordered">
            <thead>
             <tr>
                <th colspan="5">Senin</th>
              <tr>
                    <th>Nama Guru</th>
                    <th>Jam</th>
                    <th>Mapel</th>
                    <th>Action </th>
                </tr>
            </thead>
              @foreach ($jadwal as $item)
              <tr>

              @if ($item->hari=='Senin')
              <td>{{$item->name}}</td>
              <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
              <td>{{$item->studi}}</td>
              <td>
                 <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                    <i class="">Detail</i>
              </a>
              </td>
              </tr>
          @endif
            <label class="mt-auto mb-auto">
            <!-- todo: show category title -->
           
          @endforeach
          
          
         </table>
       </ul>
    </div>
               
              </table>

              {{--  --}}

              
      <div class="card-body">
         <ul class="list-group list-group-flush">
           <table class="table table-bordered">
              <thead>
               <tr>
                  <th colspan="5">Selasa</th>
                <tr>
                      <th>Nama Guru</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @foreach ($jadwal as $item)
                @if ($item->hari=='Selasa')
                <td>{{$item->name}}</td>
                <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                <td>{{$item->studi}}</td>
                <td> <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                  <i class="">Detail</i>
            </a>
                </td>
                </tr>
            @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
                 
                </table>
                {{--  --}}
                
              
      <div class="card-body">
         <ul class="list-group list-group-flush">
           <table class="table table-bordered">
              <thead>
               <tr>
                  <th colspan="5">Rabu</th>
                <tr>
                      <th>Nama Guru</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @foreach ($jadwal as $item)
                @if ($item->hari=='Rabu')
                <td>{{$item->name}}</td>
                <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                <td>{{$item->studi}}</td>
                <td>
                  <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                     <i class="">Detail</i>
               </a>
                </td>
                </tr>
            @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
                 
                </table>
                {{--  --}}
                
              
      <div class="card-body">
         <ul class="list-group list-group-flush">
           <table class="table table-bordered">
              <thead>
               <tr>
                  <th colspan="5">Kamis</th>
                <tr>
                      <th>Nama Guru</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @foreach ($jadwal as $item)
                @if ($item->hari=='Kamis')
                <td>{{$item->name}}</td>
                <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                <td>{{$item->studi}}</td>
                <td>
                  <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                     <i class="">Detail</i>
               </a>
                </td>
                </tr>
            @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
                 
                </table>
                {{--  --}}
                
              
      <div class="card-body">
         <ul class="list-group list-group-flush">
           <table class="table table-bordered">
              <thead>
               <tr>
                  <th colspan="5">Jumat</th>
                <tr>
                      <th>Nama Guru</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @foreach ($jadwal as $item)
                @if ($item->hari=='Jumat')
                <td>{{$item->name}}</td>
                <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                <td>{{$item->studi}}</td>
                <td>
                  <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                     <i class="">Detail</i>
               </a>
                </td>
                </tr>
            @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
                 
                </table>
                {{--  --}}
                
              
      <div class="card-body">
         <ul class="list-group list-group-flush">
           <table class="table table-bordered">
              <thead>
               <tr>
                  <th colspan="5">Sabtu</th>
                <tr>
                      <th>Nama Guru</th>
                      <th>Jam</th>
                      <th>Mapel</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @foreach ($jadwal as $item)
                @if ($item->hari=='Sabtu')
                <td>{{$item->name}}</td>
                <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                <td>{{$item->studi}}</td>
                <td>
                  <a href="{{route('jadwalsiswa.show',['jadwalsiswa'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                     <i class="">Detail</i>
               </a>
                </td>
                </tr>
            @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
                 
                </table>
                {{--  --}}
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