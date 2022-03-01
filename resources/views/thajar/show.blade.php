@extends('layouts.dashboard')

@section('title')
    Detail Jadwal Pelajaran Tahun {{$thajar->tahun}}
@endsection

@section('breadcrumbs')   
{{Breadcrumbs::render('detailjadwal')}}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-header">
               <div class="col-md-6">
                  <form action="{{route('thajar.show',['thajar'=>$thajar->id])}}" method="GET">
                     <div class="input-group">
                        <select name="keyword" id="" class="form-control @error('kelas') is-invalid @enderror">
                           <option value="">pilih kelas</option>
                           @foreach ($kelas as $item)
                           <option value="{{$item->id}}" {{old('kelas_id')==$item->id ? 'selected':null}}>{{$item->kelas}} {{$item->nama_kelas}}</option>
                           @endforeach
                       </select>
                        <div class="input-group-append">
                           <button class="btn btn-primary" type="submit">
                              <i class="fas fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </form>
               </div>
              <div class="card-body">
                    <!-- list category -->
                    @if ($awal<$akhir)
                        
                       <table class="table table-bordered">
                        <thead>
                         <tr>
                            <th colspan="5">Senin</th>
                          <tr>
                                <th>Nama Guru</th>
                                <th>Jam</th>
                                <th>Mapel</th>
                            </tr>
                        </thead>
                          @foreach ($jadwal as $item)
                          @if ($item->hari=='Senin')
                               <tr>
                           <td>{{$item->name}}</td>
                           <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                           <td>{{$item->studi}}</td>
                             </tr>
                        </label>
                          @endif
                        <label class="mt-auto mb-auto">
                        <!-- todo: show category title -->
                       
                      @endforeach
                      
            <thead>
             <tr>
                <th colspan="5">Selasa</th>
              <tr>
                    <th>Nama Guru</th>
                    <th>Jam</th>
                    <th>Mapel</th>
                </tr>
            </thead>
              @foreach ($jadwal as $item)
              @if ($item->hari=='Selasa')
                   <tr>
               <td>{{$item->name}}</td>
               <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
               <td>{{$item->studi}}</td>
            </tr>
           
            </label>
              @endif
            <label class="mt-auto mb-auto">
            <!-- todo: show category title -->
           
          @endforeach
          
      <thead>
       <tr>
          <th colspan="5">Rabu</th>
        <tr>
              <th>Nama Guru</th>
              <th>Jam</th>
              <th>Mapel</th>
          </tr>
      </thead>
        @foreach ($jadwal as $item)
        @if ($item->hari=='Rabu')
             <tr>
         <td>{{$item->name}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->studi}}</td>
      </tr>
     
      </label>
        @endif
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
     
    @endforeach
    
      <thead>
       <tr>
          <th colspan="5">Kamis</th>
        <tr>
              <th>Nama Guru</th>
              <th>Jam</th>
              <th>Mapel</th>
          </tr>
      </thead>
        @foreach ($jadwal as $item)
        @if ($item->hari=='Kamis')
             <tr>
         <td>{{$item->name}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->studi}}</td>
      </tr>
     
      </label>
        @endif
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
     
    @endforeach
    
 
      <thead>
       <tr>
          <th colspan="5">Jumat</th>
        <tr>
              <th>Nama Guru</th>
              <th>Jam</th>
              <th>Mapel</th>
          </tr>
      </thead>
        @foreach ($jadwal as $item)
        @if ($item->hari=='Jumat')
             <tr>
         <td>{{$item->name}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->studi}}</td>
      </tr>
     
      </label>
        @endif
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
     
    @endforeach
    
    
      <thead>
       <tr>
          <th colspan="5">Sabtu</th>
        <tr>
              <th>Nama Guru</th>
              <th>Jam</th>
              <th>Mapel</th>
          </tr>
      </thead>
        @foreach ($jadwal as $item)
        @if ($item->hari=='Sabtu')
             <tr>
         <td>{{$item->name}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->studi}}</td>
      </tr>
     
      </label>
        @endif
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
     
    @endforeach
    
    
   </table>
                        
                    @endif
   </ul>
</div>
{{--  --}}
                 </ul>
              </div>
              <div class="card-footer">
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


@push('javascript-internal')
    <script>
       $(document).ready(function(){
          $("form[role='alert']").submit(function(event){
             event.preventDefault();
             Swal.fire({
                  title: "Hapus ?",
                  icon: 'warning',
                  allowOutsideClick: false,
                  showCancelButton: true,
                  cancelButtonText: "Cancel",
                  reverseButtons: true,
                  confirmButtonText: "Yes",
               }).then((result) => {
                  if (result.isConfirmed) {
                     // todo: process of deleting categories
                     event.target.submit();
                  }
               });
          });
       });
    </script>
@endpush