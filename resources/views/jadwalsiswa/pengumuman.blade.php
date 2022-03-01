@extends('layouts.dashboard')

@section('title')
    Pengumuman
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('pengumuman')}}
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
                      <th scope="col" colspan="2"><h4>Pengumuman</h4></th>
                    </th>
                  </tr>
              </thead>
              <tbody>
                <ul class="pl-1 my-1" style="list-style :none;">
                    <li class="form-group form-check my-1">
                <tr>
                    <td><b>{{$pengumumansiswa->pengumuman}}</b></td>
                </tr>
            </li>
        </ul>
          </tbody>
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
    </script>
@endpush