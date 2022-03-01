    <div class="card-body">
    <ul class="list-group list-group-flush">
      <h2 align="center">
        {{$lihatjadwal->id}}
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

<script type="text/javascript">
window.print();
</script>