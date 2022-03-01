@extends('layouts.dashboard')

@section('title')
    Tugas
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('tugas')}}
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
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr align="center">
                      <th scope="col" colspan="3"><h4>Tugas</h4></th>
                    </th>
                  </tr>
              </thead>
              <tbody>
                <ul class="pl-1 my-1" style="list-style :none;">
                    <li class="form-group form-check my-1">
                <tr>
                    <td><b >{{$tugassiswa->tugas}}</b></td>
                    <td>@if ($tugassiswa->konten==!null)
                      <a href="{{route('tugassiswa.edit',['tugassiswa'=>$tugassiswa->id])}}" class="btn btn-sm btn-info" role="button">
                        <i>Download </i>
                    </a>
                    @endif</td>
                    <td>@if ($tugassiswa->link==!null)
                      <a href="{{$tugassiswa->link}}" class="btn btn-sm btn-info" role="button">
                      {{$tugassiswa->link}}
                    </a>
                    @endif</td>
                  </tr>
            </li>
        </ul>
          </tbody>
          
          <tr>
            <td>Input Jawaban : </td>
            <td>
             
              <form action="{{(route('tugassiswa.update',['tugassiswa'=>$tugassiswa]))}}" method="POST" enctype="multipart/form-data" role="alert">
                @csrf
                @method('PUT')
              <div class="form-group">
                <input type="file" name="jawaban" class="form-control @error('jawaban') is-invalid @enderror">
                <input type="hidden" name="id" value="{{$tugassiswa->id}}">
                @error('jawaban')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
            </div>
            <div class="float-right">
                <button type="submit" class="btn btn-primary px-4">
                         Upload
                </button>
             </div>
              </form>
                  
                @if ($jawaban->jawaban==!null)
                <h5> Anda Sudah Mengirim Jawaban</h5>
                    
                @endif
            </td>
          </tr>
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
       $(document).ready(function(){
          $("form[role='alert']").submit(function(event){
             event.preventDefault();
             Swal.fire({
                  title: "Upload?",
                  text: "",
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