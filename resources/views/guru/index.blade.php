@extends('layouts.dashboard')

@section('title')
    Guru
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('guru')}}
@endsection

@section('content')
    <!-- section:content -->
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                   <form action="{{route('guru.index')}}" method="GET">
                      <div class="input-group">
                         <input name="keyword" type="search" class="form-control" placeholder="Search for guru">
                         <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                               <i class="fas fa-search"></i>
                            </button>
                         </div>
                      </div>
                   </form>
                </div>
                <div class="col-md-6">
                   <a href="{{route('guru.create')}}" class="btn btn-primary float-right" role="button" value="">
                      Add new
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
             <ul class="list-group list-group-flush">
                <!-- list guru -->
               @if (count($guru))
               @foreach ($guru as $item)
                        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                           <label class="mt-auto mb-auto">
                           <!-- todo: show category title -->
                           {{$item->name}}
                           </label>
                           <div>
                              <a href="{{route('guru.show',['guru'=>$item])}}" class="btn btn-sm btn-primary" role="button">
                                 <i class="fas fa-eye"></i>
                             </a>
                           <!-- edit -->
                           <a href="{{route('guru.edit',['guru'=>$item])}}" class="btn btn-sm btn-info" role="button">
                              <i class="fas fa-edit"></i>
                           </a>
                           <!-- delete -->
                           <form class="d-inline" action="{{route('guru.destroy',['guru'=>$item])}}" role="alert" method="POST">
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
                  Guru {{request()->get('keyword')}} tidak ditemukan
               @endif
             </ul>
          </div>
          <div class="card-footer">
            {{$guru->links('vendor.pagination.bootstrap-4')}}
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