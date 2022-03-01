@extends('layouts.dashboard')

@section('title')
    Edit Tahun Ajaran
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('tambah tahun pelajaran')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('thajar.update',['thajar'=>$thajar->id])}}" method="POST">
               @method('PUT') 
               @csrf
                <!-- title -->
               
                <div class="form-group">
                    <label for="input_deskripsi" class="font-weight-bold">
                        Tahun Ajaran
                     </label>
                    <input  value="{{old('tahun',$thajar->tahun)}}" name="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror"  />
                    @error('tahun')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('jadwal.index')}}">Back</a>
                	<button type="submit" class="btn btn-primary px-4">Save</button>
                </div>                
             </form>
          </div>
       </div>
    </div>
 </div>

@endsection

@push('css-external')
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2-bootstrap4.min.css')}}">
@endpush

@push('javascript-external')
    <script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/js/i18n/in.js') }}"></script>
@endpush

@push('javascript-internal')
<script>
    $(document).ready(function(){
       $("form[role='alert']").submit(function(event){
          event.preventDefault();
          Swal.fire({
               title: "Yakin Tambah Data?",
               text: "jadwal tahun sebelumnya akan di pindahkan ke arsip jadwal",
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