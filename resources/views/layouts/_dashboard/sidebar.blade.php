<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
       <div class="nav">
          <a class="nav-link {{ set_active('dashboard.index')}}" href="{{route('dashboard.index')}}">
             <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
             </div>
             Dashboard
          </a>
         
 
          @if (auth()->user()->level=="admin")
          <div class="sb-sidenav-menu-heading">Master</div>
          <a class="nav-link {{ set_active(['guru.index','guru.create','guru.edit'])}}" href="{{route('guru.index')}}">
             <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
             </div>
             Guru
          </a>  
          {{-- menu studi --}}
          <a class="nav-link {{ set_active(['studi.index','studi.create','studi.edit'])}}" href="{{route('studi.index')}}">
             <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
             </div>
             Mapel
          </a>
          <a class="nav-link {{ set_active(['siswa.index','siswa.create','siswa.edit','siswa.show'])}}" href="{{route('siswa.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Siswa
         </a>
          <a class="nav-link {{ set_active(['kelas.index','kelas.create','kelas.edit','kelas.show'])}}" href="{{route('kelas.index')}}">
             <div class="sb-nav-link-icon">
                <i class="fas fa-tags"></i>
             </div>
             Kelas
          </a>
          <a class="nav-link {{ set_active(['matkulkelas.index','matkulkelas.create','matkulkelas.show'])}}" href="{{route('matkulkelas.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Mapelkelas
         </a>
          <a class="nav-link {{ set_active(['jadwal.index','jadwal.create','jadwal.edit','jadwal.show','thajar.create'])}}" href="{{route('jadwal.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Jadwal
         </a>
         <div class="sb-sidenav-menu-heading">Arsip</div>
         <a class="nav-link {{ set_active(['thajar.index','thajar.show'])}}" href="{{route('thajar.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Jadwal
         </a>
         @endif
         @if (auth()->user()->level=="guru")
         <div class="sb-sidenav-menu-heading">Master</div>
         <a class="nav-link " href="{{route('pengumuman.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Pengumuman
         </a>
         <a class="nav-link " href="{{route('materi.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Materi
            
         </a>
         
         <a class="nav-link " href="{{route('tugas.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Tugas
         </a>
         <div class="sb-sidenav-menu-heading">Arsip</div>
         <a class="nav-link {{ set_active(['arsipmateri.index','arsipmateri.show'])}}" href="{{route('arsipmateri.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Materi
         </a>
         <a class="nav-link {{ set_active(['thajar.index','thajar.show'])}}" href="{{route('thajar.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            Jadwal
         </a>
         @endif
         @if (auth()->user()->level=="siswa")
         
     
         <div class="sb-sidenav-menu-heading">Pengumuman</div>
         @foreach ($pengumuman1 as $item)
         <a class="nav-link " href="{{route('pengumumansiswa.show',['pengumumansiswa'=>$item->id])}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            {{-- {{$item->matkulkelas->kelas->kelas}}
            {{$item->matkulkelas->kelas->nama_kelas}}
            {{$item->matkulkelas->studi->studi}} --}}
            {{$item->studi}}
            
         </a>
      @endforeach
       @if (count($pengumuman1)<1)
           <div class="nav-link ">
             <b>tidak ada pengumuman</b>
         </div>
       @endif
         <div class="sb-sidenav-menu-heading">Tugas</div>
         @foreach ($tugas1 as $item)
         <a class="nav-link " href="{{route('tugassiswa.show',['tugassiswa'=>$item->id])}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            {{-- {{$item->matkulkelas->kelas->kelas}}
            {{$item->matkulkelas->kelas->nama_kelas}}
            {{$item->matkulkelas->studi->studi}} --}}
            {{$item->studi}}
         </a>
      @endforeach
         @if (count($tugas1)<1)
         <div class="nav-link ">
           <b>tidak ada tugas</b>
       </div>
     @endif
     <div class="sb-sidenav-menu-heading">Arsip</div>
     <a class="nav-link {{ set_active(['thajar.index','thajar.show'])}}" href="{{route('jadwalsiswa.index')}}">
        <div class="sb-nav-link-icon">
           <i class="fas fa-tags"></i>
        </div>
        Jadwal
     </a>
         @endif
         
       </div>
    </div>
 </nav>
 