@extends('layouts.dashboard')

@section('title')
    Detail Jadwal Pelajaran Tahun {{$th->tahun}}
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
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('jadwal.store')}}" method="POST">
                           @csrf
                           @foreach ($kelas as $item)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                          <label class="mt-auto mb-auto">
                          <!-- todo: show category title -->
                          {{$item->kelas}}
                          {{$item->nama_kelas}}
                          </label>
                          <input type="hidden" name="kelas_id" value="{{$item->id}}">
                                 </li>
                                    @endforeach  
                                       <div class="form-group">
                                          <label for="input_name" class="font-weight-bold"></label>
                                       <select name="matkulkelas" id="" class="form-control @error('matkulkelas') is-invalid @enderror">
                                          <option value="">Pilih Mapel</option>
                                          @foreach ($matkulkelas as $item)
                                             <option value="{{$item->id}}"}}>{{$item->studi->studi}}</option>
                                          @endforeach
                                       </select>
                                       @error('matkulkelas')
                                          <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                                       </div>
                                       <div class="form-group">
                                          <select name="hari" id="" class="form-control @error('hari') is-invalid @enderror">
                                             <option value="{{old('hari')}}">Hari</option>
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
                                    <div class="form-group">
                                    <select name="guru" id="" class="form-control @error('guru') is-invalid @enderror">
                                          <option value="">Pilih Guru</option>
                                          @foreach ($guru as $item)
                                             <option value="{{$item->id}}"}}>{{$item->name}}</option>
                                          @endforeach
                                    </select>
                                    @error('guru')
                                          <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    </div>
                              <div class="col-md-6">
                           </div>
                              </div>
                              {{-- rata kanan --}}
                              <div class="col-md-6">
                                 <div class="form-group"  >
                                    <label for="input_kelas" class="font-weight-bold">
                                    Jam Mulai
                                    </label>
                                    <div class="form-group">
                                       <select name="jam_mulai" id="" class="form-control @error('jam_mulai') is-invalid @enderror">
                                           <option value="{{old('jam_mulai')}}">{{old('jam_mulai')}}</option>
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
                                           <option value="{{old('jam_selesai')}}">{{old('jam_selesai')}}</option>
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
                                 <div class="float-right">
                                    <a class="btn btn-danger px-4" href="{{route('jadwal.index')}}">Back</a>
                                    <button type="submit" class="btn btn-primary px-4">Add</button>
                                 </div> 
                                 </div>
                              </form>
                  </div>
                  @foreach ($kelas as $item)
                     <h4>Jadwal Pelajaran {{$item->kelas}} {{$item->nama_kelas}}
                     {{-- </h4><a href="{{route('jadwal.printpdf',['jadwal'=>$item->id])}}" target="_blank" class="btn btn-primary">Print PDF</a> --}}
                  @endforeach
              </div>
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
                                  <th>Action</th>
                              </tr>
                          </thead>
                            @foreach ($jadwal as $item)
                            @if ($item->hari=='Senin')
                                 <tr>
                             <td>{{$item->name}}</td>
                             <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                             <td>{{$item->studi}}</td>
                             <td>
                                <div>
                                   <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                                      <i class="fas fa-edit"></i>
                                  </a>
                                  <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                                      @csrf
                                      @method('delete')
                                      <button type="submit" class="btn btn-sm btn-danger">
                                      <i class="fas fa-trash"></i>
                                      </button>
                                  </form>
                                </div>
                             </td>
                          </tr>
                         
                          </label>
                            @endif
                          <label class="mt-auto mb-auto">
                          <!-- todo: show category title -->
                         
                        @endforeach
                        
                        
                       </table>
                     </ul>
                  </div>
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
                     <tr>
                 <td>{{$item->name}}</td>
                 <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
                 <td>{{$item->studi}}</td>
                 <td>
                    <div>
                       <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                          <i class="fas fa-edit"></i>
                      </a>
                      <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-danger">
                          <i class="fas fa-trash"></i>
                          </button>
                      </form>
                    </div>
                 </td>
              </tr>
             
              </label>
                @endif
              <label class="mt-auto mb-auto">
              <!-- todo: show category title -->
             
            @endforeach
            
            
           </table>
         </ul>
      </div>
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
               <tr>
           <td>{{$item->name}}</td>
           <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
           <td>{{$item->studi}}</td>
           <td>
              <div>
                 <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
              </div>
           </td>
        </tr>
       
        </label>
          @endif
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
       
      @endforeach
      
      
     </table>
   </ul>
</div>
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
               <tr>
           <td>{{$item->name}}</td>
           <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
           <td>{{$item->studi}}</td>
           <td>
              <div>
                 <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
              </div>
           </td>
        </tr>
       
        </label>
          @endif
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
       
      @endforeach
      
      
     </table>
   </ul>
</div>
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
               <tr>
           <td>{{$item->name}}</td>
           <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
           <td>{{$item->studi}}</td>
           <td>
              <div>
                 <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
              </div>
           </td>
        </tr>
       
        </label>
          @endif
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
       
      @endforeach
      
      
     </table>
   </ul>
</div>
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
               <tr>
           <td>{{$item->name}}</td>
           <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
           <td>{{$item->studi}}</td>
           <td>
              <div>
                 <a href="{{route('jadwal.edit',['jadwal'=>$item->id])}}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline" action="{{route('jadwal.destroy',['jadwal'=>$item->id])}}" role="alert" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
              </div>
           </td>
        </tr>
       
        </label>
          @endif
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
       
      @endforeach
      
      
     </table>
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