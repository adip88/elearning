@extends('layouts.dashboard')

@section('title')
    Materi
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('materi')}}
@endsection

@section('content')
    <!-- section:content -->
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                  
                </div>
                <div class="col-md-6">
                  
                   <a href="{{route('materi.create')}}" class="btn btn-primary float-right" role="button" value="">
                      Add new
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
             <ul class="list-group list-group-flush">
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
                  <!-- edit -->
                  <a href="{{route('materi.edit',['materi'=>$item])}}" class="btn btn-sm btn-info" role="button">
                     <i class="fas fa-edit"></i>
                  </a>
                  <!-- delete -->
                  <form class="d-inline" action="{{route('materi.destroy',['materi'=>$item])}}" role="alert" method="POST">
                     @csrf
                     @method('delete')
                     <button type="submit" class="btn btn-sm btn-danger">
                     <i class="fas fa-trash"></i>
                     </button>
                 </form>
                  </div>
               </li>  
              <ul> <label for="">
               @if ($item->deskripsi==!'')
               =>
               @endif  {{$item->deskripsi}}</label></ul>
               @endforeach     
          </div>
          <div class="card-footer">
            {{$materi->links('vendor.pagination.bootstrap-4')}}
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