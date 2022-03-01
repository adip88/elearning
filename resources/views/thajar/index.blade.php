@extends('layouts.dashboard')

@section('title')
    Arsip Data Jadwal Pelajaran
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('arsip')}}
@endsection

@section('content')
   <!-- section:content -->
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
           <div class="row">
               <div class="col-md-6">
              <div class="col-md-6">
            </div>
               </div>
               <div class="col-md-6">
                 </a>
               </div>
            </div>
         </div>
         
         <div class="card-body">
            <ul class="list-group list-group-flush">
               <!-- list category -->

              @foreach ($thajar as $item)
              <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                 <label class="mt-auto mb-auto">
                 <!-- todo: show category title -->
                 {{$item->tahun}}
                 </label>
                 <div>
                  <th>
                    <a href="{{route('thajar.show',['thajar'=>$item->id])}}" class="btn btn-sm btn-primary" role="button">
                       <i class="fas fa-eye"></i>
                   </a>
                   @if (Auth::user()->level=='admin')
                       
                        <form class="d-inline" action="{{route('thajar.destroy',['thajar'=>$item->id])}}" role="alert" method="POST">
                           @csrf
                           @method('delete')
                           <button type="submit" class="btn btn-sm btn-danger">
                           <i class="fas fa-trash"></i>
                           </button>
                     </form>
                   @endif
                 </div>
              </li>
              @endforeach     
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
       $(document).ready(function(){
          $("form[role='alert']").submit(function(event){
             event.preventDefault();
             Swal.fire({
                  title: "Hapus Data?",
                  text: "Semua data pelajaran di tahun ini akan ikut terhapus",
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