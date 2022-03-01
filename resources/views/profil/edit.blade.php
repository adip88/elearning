@extends('layouts.dashboard')

@section('title')
    Edit Profil
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('profil/edit')}}
@endsection

@section('content')
<div class="row">
   <div class="col-md-12">
      <form action=" {{route('profil.update',['profil'=>$user->id])}}" method="POST" >
         @csrf
         @method('PATCH')
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-12">
                      
                  
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email',$user->email)}}">
                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div> 
                @if (Auth::user()->level=="guru" or Auth::user()->level=="siswa")
                <div class="form-group">
                    <label>No Hp</label>
                    <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" autofocus required value="{{old('no_hp',$user->no_hp)}}">
                    @error('no_hp')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>  
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" required >{{old('alamat',$user->alamat)}}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>  
                  
            @endif
               </div>
              
                     
               <div class="float-right">
                <a class="btn btn-danger px-4" href="{{route('profil.index')}}">Back</a>
                <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
               
            </div>
         </div>
      </form>
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