@extends('layouts.dashboard')

@section('title')
    Detail Studi
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('detail_studi_title', $studi)}}      
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <table class="table  col-md-4">
                 <tbody>
                    <tr>
                        <th>Matkul</th>
                        <td>{{$studi->studi}}</td>
                    </tr>

                    <tr>
                        <th>Jumlah Guru</th>
                        <td>{{$count}}</td>
                    </tr>
                    
                    
                </tbody>
            </table>
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nama Guru</th>
                      <th scope="col">Email</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($guru as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                </tr>
                @endforeach
          </tbody>
      </table>
            </div>
             <div class="d-flex justify-content-end">
                <a href="{{route('studi.index')}}" class="btn btn-primary mx-1" role="button">
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