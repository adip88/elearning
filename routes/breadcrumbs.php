<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Dashboard => home
Breadcrumbs::for('dashboard_home', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('home', '#');
});

// Dashboard => profil
Breadcrumbs::for('profil', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('profil', route('profil.index'));
});

// Dashboard => profil /edit
Breadcrumbs::for('profil/edit', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('edit profil', route('profil.index'));
});

// Dashboard => profil /edit
Breadcrumbs::for('profil/password', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('change password', route('profil.index'));
});

// Dashboard => studi
Breadcrumbs::for('studi', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('mapel', route('studi.index'));
});

// Dashboard => studi / add
Breadcrumbs::for('add_studi', function ($trail) {
    $trail->parent('studi');
    $trail->push('add', route('studi.create'));
});

// Dashboard => studi / edit
Breadcrumbs::for('edit_studi', function ($trail,$studi) {
    $trail->parent('studi');
    $trail->push('edit', route('studi.edit',['studi'=>$studi]));
});

// Dashboard => studi / edit / title
Breadcrumbs::for('edit_studi_title', function ($trail,$studi) {
    $trail->parent('edit_studi',$studi);
    $trail->push($studi->studi, route('studi.edit',['studi'=>$studi]));
});

// Dashboard => Studi / show
Breadcrumbs::for('detail_studi', function ($trail,$studi) {
    $trail->parent('studi');
    $trail->push('Detail', route('studi.show',['studi'=>$studi]));
});

// Dashboard => studi / edit / title
Breadcrumbs::for('detail_studi_title', function ($trail,$studi) {
    $trail->parent('detail_studi',$studi);
    $trail->push($studi->studi, route('studi.show',['studi'=>$studi]));
});

// Dashboard => guru
Breadcrumbs::for('guru', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('guru', route('guru.index'));
});

// Dashboard => guru / add
Breadcrumbs::for('add_guru', function ($trail) {
    $trail->parent('guru');
    $trail->push('add', route('guru.create'));
});

// Dashboard => kelas / show
Breadcrumbs::for('detail_guru', function ($trail,$guru) {
    $trail->parent('guru');
    $trail->push('Detail', route('guru.show',['guru'=>$guru]));
});

// Dashboard => kelas / edit / title
Breadcrumbs::for('detail_guru_title', function ($trail,$guru) {
    $trail->parent('detail_guru',$guru);
    $trail->push($guru->name, route('guru.show',['guru'=>$guru]));
});

// Dashboard => edit / edit
Breadcrumbs::for('edit_guru', function ($trail,$guru) {
    $trail->parent('guru');
    $trail->push('edit', route('guru.edit',['guru'=>$guru]));
});

// Dashboard => guru / edit / title
Breadcrumbs::for('edit_guru_title', function ($trail,$guru) {
    $trail->parent('edit_guru',$guru);
    $trail->push($guru->name, route('guru.edit',['guru'=>$guru]));
});

// Dashboard => kelas
Breadcrumbs::for('kelas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('kelas', route('kelas.index'));
});

// Dashboard => kelas / add
Breadcrumbs::for('add_kelas', function ($trail) {
    $trail->parent('kelas');
    $trail->push('add', route('kelas.create'));
});

// Dashboard => kelas / edit
Breadcrumbs::for('edit_kelas', function ($trail,$kelas) {
    $trail->parent('kelas');
    $trail->push('Edit', route('kelas.edit',['kela'=>$kelas]));
});

// Dashboard => kelas / edit / title
Breadcrumbs::for('edit_kelas_title', function ($trail,$kelas) {
    $trail->parent('edit_kelas',$kelas);
    $trail->push($kelas->kelas.' '.$kelas->nama_kelas, route('kelas.edit',['kela'=>$kelas]));
});

// Dashboard => kelas / show
Breadcrumbs::for('detail_kelas', function ($trail,$kelas) {
    $trail->parent('kelas');
    $trail->push('Detail', route('kelas.show',['kela'=>$kelas]));
});

// Dashboard => kelas / edit / title
Breadcrumbs::for('detail_kelas_title', function ($trail,$kelas) {
    $trail->parent('detail_kelas',$kelas);
    $trail->push($kelas->kelas.' '.$kelas->nama_kelas, route('kelas.show',['kela'=>$kelas]));
});

// Dashboard => siswa
Breadcrumbs::for('siswa', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('siswa', route('siswa.index'));
});

// Dashboard => siswa / add
Breadcrumbs::for('add_siswa', function ($trail) {
    $trail->parent('siswa');
    $trail->push('add', route('siswa.create'));
});

// Dashboard => siswa / edit
Breadcrumbs::for('edit_siswa', function ($trail,$siswa) {
    $trail->parent('siswa');
    $trail->push('edit', route('siswa.edit',['siswa'=>$siswa]));
});

// Dashboard => siswa / edit / title
Breadcrumbs::for('edit_siswa_title', function ($trail,$siswa) {
    $trail->parent('edit_siswa',$siswa);
    $trail->push($siswa->name, route('siswa.edit',['siswa'=>$siswa]));
});

// Dashboard => siswa / show
Breadcrumbs::for('detail_siswa', function ($trail,$siswa) {
    $trail->parent('siswa');
    $trail->push('detail', route('siswa.show',['siswa'=>$siswa]));
});

// Dashboard => siswa / edit / title
Breadcrumbs::for('detail_siswa_title', function ($trail,$siswa) {
    $trail->parent('detail_siswa',$siswa);
    $trail->push($siswa->name, route('siswa.show',['siswa'=>$siswa]));
});

// Dashboard => jadwal
Breadcrumbs::for('jadwal', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('jadwal', route('jadwal.index'));
});

// Dashboard => jadwal / add
Breadcrumbs::for('add_jadwal', function ($trail) {
    $trail->parent('jadwal');
    $trail->push('add', route('jadwal.create'));
});

// Dashboard => jadwal detail
Breadcrumbs::for('detailjadwal', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('detail jadwal', route('jadwal.index'));
});

// Dashboard => jadwal / edit
Breadcrumbs::for('edit_jadwal', function ($trail,$jadwal) {
    $trail->parent('jadwal');
    $trail->push('edit', route('jadwal.edit',['jadwal'=>$jadwal]));
});

// Dashboard => jadwal / edit / title
Breadcrumbs::for('edit_jadwal_title', function ($trail,$jadwal) {
    $trail->parent('edit_jadwal',$jadwal);
    $trail->push($jadwal->hari, route('jadwal.edit',['jadwal'=>$jadwal]));
});

// Dashboard => matkulkelas
Breadcrumbs::for('matkulkelas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('matkulkelas', route('matkulkelas.index'));
});


// Dashboard => matkulkelas detail
Breadcrumbs::for('detailmatkulkelas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('detail matkulkelas', route('matkulkelas.index'));
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Dashboard => jadwal
Breadcrumbs::for('jadwal2', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('jadwal', route('lihatjadwal.index'));
});

// Dashboard => jadwal
Breadcrumbs::for('detail_jadwal2', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Detail jadwal', route('lihatjadwal.index'));
});

// Dashboard => pengumuman
Breadcrumbs::for('pengumuman', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('pengumuman', route('pengumuman.index'));
});

// Dashboard => pengumuman
Breadcrumbs::for('materi', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('materi', route('materi.index'));
});

// Dashboard => pengumuman
Breadcrumbs::for('tugas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('tugas', route('tugas.index'));
});

/////////////////////////////////////////////////////////
// Dashboard => Arsip
Breadcrumbs::for('arsip', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('arsip', route('thajar.index'));
});

Breadcrumbs::for('tambah tahun pelajaran', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tambah Tahun pelajaran', route('thajar.create'));
});