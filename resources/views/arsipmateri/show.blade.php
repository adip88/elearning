@extends('layouts.dashboard')

@section('title')
    Arsip Materi 
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

              @foreach ($materi as $item)
              <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
               {{$item->matkulkelas->kelas->kelas}}  {{$item->matkulkelas->kelas->nama_kelas}}  {{$item->matkulkelas->studi->studi}} 
               <label class="mt-auto mb-auto">
               <!-- todo: show category title -->
               {{$item->judul}}  
               </label>
               {{$item->konten}} 
              <a href="{{$item->link}}" target="blank">{{$item->link}}</a>  
               <div>
                @if ($item->konten==!null)
                <a href="{{route('materi.show',['materi'=>$item])}}" class="btn btn-sm btn-primary" role="button">
                  <i class="fas fa-eye"></i>
              </a>
                @endif
               </div>
            </li>  
           <ul> <label for="">
            @if ($item->deskripsi==!'')
            =>
            @endif  {{$item->deskripsi}}</label></ul>
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