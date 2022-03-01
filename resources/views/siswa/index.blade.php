@extends('layouts.dashboard')

@section('title')
    Siswa
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('siswa')}}
@endsection

@section('content')
    <!-- section:content -->
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                   <form action="{{route('siswa.index')}}" method="GET">
                      <div class="input-group">
                         <input name="keyword" type="search" class="form-control" placeholder="Search for siswa">
                         <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                               <i class="fas fa-search"></i>
                            </button>
                         </div>
                      </div>
                   </form>
                </div>
                <div class="col-md-6">
                   <a href="{{route('siswa.create')}}" class="btn btn-primary float-right" role="button" value="">
                      Add new
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
             <ul class="list-group list-group-flush">
                <!-- list category -->
                
                @if (count($siswa))
                @include('siswa._siswa-list',[
                        'siswa'=>$siswa,
                ])
               @else
                  siswa {{request()->get('keyword')}} tidak ditemukan
               @endif
             </ul>
          </div>
          <div class="card-footer">
            {{$siswa->links('vendor.pagination.bootstrap-4')}}
          </div>
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
                  title: "Hapus Data?",
                  text: "data yang di hapus tidak dapat dikembalikan",
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