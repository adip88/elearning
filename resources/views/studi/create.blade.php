@extends('layouts.dashboard')

@section('title')
    Add Mapel
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('add_studi')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{route('studi.store')}}" method="POST">
                @csrf
                <!-- title -->
                <div class="form-group">
                   <label for="input_studi" class="font-weight-bold">
                      Mapel
                   </label>
                   <input id="input_studi" value="{{old('studi')}}" name="studi" type="text" class="form-control @error('studi') is-invalid @enderror" placeholder="enter mapel"/>
                   @error('studi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- parent_category -->
                {{-- <div class="form-group">
                   <label for="select_studi_parent" class="font-weight-bold">Parent</label>
                   <select id="select_studi_parent" name="parent_studi" data-placeholder="" class="custom-select w-100">
                   </select>
                </div> --}}
                <div class="float-right">
                	<a class="btn btn-danger px-4" href="{{route('studi.index')}}">Back</a>
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
   
    </script>
@endpush