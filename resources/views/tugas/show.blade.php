@extends('layouts.dashboard')

@section('title')
    Detail Tugas
@endsection

@section('breadcrumbs')     
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <table class="table  col-md-4">
                <tbody>
                    <tr>
                        <th>judul</th>
                        <td>{{$tuga->judul}}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{$tuga->tugas}}</td>
                    </tr>
                   
                    
                </tbody>
                <th>
                    <form class="d-inline" action="{{route('tugas.all',['tuga'=>$tuga->id])}}" role="" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-danger">
                        <i>Download Semua</i>
                        </button>
                    </form>
                </th>
            </table>
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                        <th scope="col">Nama Siswa</th>
                      <th scope="col">Jawaban</th>
                      <th scope="col">Nilai</th> 
                      <th scope="col">Action</th>    
                  </tr>
              </thead>
              <tbody>
                <ul class="pl-1 my-1" style="list-style :none;">
                    <li class="form-group form-check my-1">
              @foreach ($jawaban as $item)
                <tr>
                    
                    <td>{{$item->siswa->name}}</td>
                    
                    <td> 
                        @if ($item->jawaban==!null)
                        <a href="{{route('nilai.show',['nilai'=>$item])}}" target="_blank" class="btn btn-sm btn-primary" role="button">
                            <i>Jawaban Siswa</i>
                        </a>
                        @endif
                       
                </td>
                    <td>
                       @if ($item->jawaban==null)
                           siswa belum mengirimkan jawaban
                               
                        @else
                        <form action="{{route('nilai.update',['nilai'=>$item->id])}}" method="POST" enctype="multipart/form-data" role="">
                            @csrf
                            @method('PUT')
                          <div class="form-group">
                            <input type="number" name="nilai" class="form-control @error('nilai') is-invalid @enderror" value="{{$item->nilai}}" required>
                            @error('nilai')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>
                       @endif
                    </td>
                    <td>

                        <div class="">
                            @if ($item->jawaban==!null)
                            <button type="submit" class="btn btn-primary px-4">
                                Input
                       </button>
                            @endif
                           
                         </div>
                          </form>
                    </td>
                </tr>
                @endforeach
            </li>
        </ul>
          </tbody>
      </table>
            </div>
             <div class="d-flex justify-content-end">
                <a href="{{route('tugas.index')}}" class="btn btn-primary mx-1" role="button">
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


@push('javascript-internal')
    <script>
       $(document).ready(function(){
          $("form[role='alert']").submit(function(event){
             event.preventDefault();
             Swal.fire({
                  title: "Naik Kelas?",
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