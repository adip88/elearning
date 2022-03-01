@extends('layouts.dashboard')

@section('title')
    Detail Mapelkelas
@endsection

@section('breadcrumbs')   
{{Breadcrumbs::render('detailmatkulkelas')}}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
           <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('matkulkelas.store')}}" method="POST">
                            @csrf
                        <li class="list-group-item list-group-item-action d-flex justify-content-between">
                         
                           <!-- todo: show category title -->
                           <select name="kelas_id" id="" class="form-control @error('studi') is-invalid @enderror">
                                @foreach ($kelas as $item)
                                    <option value="{{$item->id}}"}}>{{$item->kelas.' '.$item->nama_kelas}}</option>
                                @endforeach
                            </select>
                           
                        </li>
                            <div class="form-group">
                                <label for="input_name" class="font-weight-bold"></label>
                            <select name="studi" id="" class="form-control @error('studi') is-invalid @enderror">
                                <option value="">Pilih Mapel</option>
                                @foreach ($studi as $item)
                                    <option value="{{$item->id}}"}}>{{$item->studi.' '.$item->name}}</option>
                                @endforeach
                            </select>
                            @error('studi')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                            </div>
                            <div class="float-right">
                                <a class="btn btn-danger px-4" href="{{route('matkulkelas.index')}}">Back</a>
                                <button type="submit" class="btn btn-primary px-4">Add</button>
                            </div> 
                        </form>    
                   <div class="col-md-6">
                 </div>
                    </div>
                    <div class="col-md-6">
                      
                    </div>
                 </div>
                 <h4>Daftar Mata Pelajaran</h4>
              </div>
              <div class="card-body">
                 <ul class="list-group list-group-flush">
                    <!-- list category -->
    
                   @if (count($kelas))
                   @foreach ($matkulkelas as $item)
                   <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                      <label class="mt-auto mb-auto">
                      <!-- todo: show category title -->
                      {{$item->studi->studi}}
                      </label>
                      <div>
                        <form class="d-inline" action="{{route('matkulkelas.destroy',['matkulkela'=>$item])}}" role="alert" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            </button>
                        </form>
                      </div>
                   </li>
                   @endforeach     
                   @else
                      Kelas {{request()->get('keyword')}} tidak ditemukan
                   @endif
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