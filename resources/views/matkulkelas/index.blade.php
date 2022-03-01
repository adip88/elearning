@extends('layouts.dashboard')

@section('title')
    Mapelkelas
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('matkulkelas')}}
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

               @if (count($kelas))
               @foreach ($kelas as $item)
               <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                  <label class="mt-auto mb-auto">
                  <!-- todo: show category title -->
                  {{$item->kelas}}
                  {{$item->nama_kelas}}
                  </label>
                  <div>
                     <a href="{{route('matkulkelas.show',['matkulkela'=>$item])}}" class="btn btn-sm btn-primary" role="button">
                        <i class="fas fa-eye"></i>
                    </a>
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