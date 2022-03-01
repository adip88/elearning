@extends('layouts.dashboard')

@section('title')
    Detail Kelas
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('detail_kelas_title', $kela)}}      
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <table class="table  col-md-4">
                <tbody>
                    <tr>
                        <th>Kelas</th>
                        <td>{{$kela->kelas.' '.$kela->nama_kelas}}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{$kela->deskripsi}}</td>
                    </tr>

                    <tr>
                        <th>Jumlah Siswa</th>
                        <td>{{$count}}</td>
                    </tr>
                    
                    
                </tbody>
            </table>
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nis</th>
                      <th scope="col">Nama Siswa</th>
                      {{-- <th scope="col">Email</th>
                      <th><a href="{{route('kelas.printpdf',['kela'=>$kela->id])}}" target="_blank" class="btn btn-primary">Print PDF</a>
                        <form class="d-inline" action="{{route('kelas.naikkelas',['kela'=>$kela->id])}}" role="alert" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger">
                            <i>Naik Kelas</i>
                            </button>
                        </form>
                    </th> --}}
                  </tr>
              </thead>
              <tbody>
                <ul class="pl-1 my-1" style="list-style :none;">
                    <li class="form-group form-check my-1">
              @foreach ($siswa as $item)
                <tr>
                    <td>{{$item->nis}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->user->email}}</td>
                </tr>
                @endforeach
            </li>
        </ul>
          </tbody>
      </table>
            </div>
             <div class="d-flex justify-content-end">
                <a href="{{route('kelas.index')}}" class="btn btn-primary mx-1" role="button">
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