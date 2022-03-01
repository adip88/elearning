    <div class="card-body">
    <ul class="list-group list-group-flush">
      <h2 align="center">
        @foreach ($kelas as $item)
        {{$item->kelas.' '.$item->nama_kelas }}
        @endforeach
       
      </h2>
      <table class="table table-bordered" border="1" width="500px" align="center">
         <thead>
           <tr>
             <th colspan="3">Senin</th>
           </tr>
             <tr>
                 <th>Mapel</th>
                 <th>Jam</th>
                 <th>Guru</th> 
             </tr>
         </thead>
           @foreach ($jadwal as $item)
         <label class="mt-auto mb-auto">
         <!-- todo: show category title -->
         @if ($item->hari=='Senin')
         <tr>
            <td>{{$item->studi}}</td>
            <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
            <td>{{$item->name}}</td>
         </tr>
             
         @endif
         </label>
         @endforeach
     </table>
     {{--  --}}<br> 
     <table class="table table-bordered" border="1" width="500px" align="center">
      <thead>
        <tr>
          <th colspan="3">Selasa</th>
        </tr>
          <tr>
              <th>Mapel</th>
              <th>Jam</th>
              <th>Guru</th> 
          </tr>
      </thead>
        @foreach ($jadwal as $item)
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      @if ($item->hari=='Selasa')
      <tr>
         <td>{{$item->studi}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->name}}</td>
      </tr>
          
      @endif
      </label>
      @endforeach
  </table>
  
     {{--  --}}<br> 
     <table class="table table-bordered" border="1" width="500px" align="center">
      <thead>
        <tr>
          <th colspan="3">Rabu</th>
        </tr>
          <tr>
              <th>Mapel</th>
              <th>Jam</th>
              <th>Guru</th> 
          </tr>
      </thead>
        @foreach ($jadwal as $item)
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      @if ($item->hari=='Rabu')
      <tr>
         <td>{{$item->studi}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->name}}</td>
      </tr>
          
      @endif
      </label>
      @endforeach
  </table>
  
     {{--  --}}<br> 
     <table class="table table-bordered" border="1" width="500px" align="center">
      <thead>
        <tr>
          <th colspan="3">Kamis</th>
        </tr>
          <tr>
              <th>Mapel</th>
              <th>Jam</th>
              <th>Guru</th> 
          </tr>
      </thead>
        @foreach ($jadwal as $item)
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      @if ($item->hari=='Kamis')
      <tr>
         <td>{{$item->studi}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->name}}</td>
      </tr>
          
      @endif
      </label>
      @endforeach
  </table>
  
     {{--  --}}<br> 
     <table class="table table-bordered" border="1" width="500px" align="center">
      <thead>
        <tr>
          <th colspan="3">Jumat</th>
        </tr>
          <tr>
              <th>Mapel</th>
              <th>Jam</th>
              <th>Guru</th> 
          </tr>
      </thead>
        @foreach ($jadwal as $item)
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      @if ($item->hari=='Jumat')
      <tr>
         <td>{{$item->studi}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->name}}</td>
      </tr>
          
      @endif
      </label>
      @endforeach
  </table>
  
     {{--  --}}<br> 
     <table class="table table-bordered" border="1" width="500px" align="center">
      <thead>
        <tr>
          <th colspan="3">Sabtu</th>
        </tr>
          <tr>
              <th>Mapel</th>
              <th>Jam</th>
              <th>Guru</th> 
          </tr>
      </thead>
        @foreach ($jadwal as $item)
      <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      @if ($item->hari=='Sabtu')
      <tr>
         <td>{{$item->studi}}</td>
         <td>{{$item->jam_mulai.' - '.$item->jam_selesai}}</td>
         <td>{{$item->name}}</td>
      </tr>
          
      @endif
      </label>
      @endforeach
  </table>
   </ul>
</div>
<div class="card-footer">
</div> 

<script type="text/javascript">
window.print();
</script>