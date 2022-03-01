<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register'=>false
]);

Route::group(['prefix' => 'dashboard','middleware'=>['web','auth','ceklevel:admin,siswa,guru']],function(){
    //dashboard
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    //profil
    Route::resource('/profil', \App\Http\Controllers\profilController::class);
    Route::patch('/changepassword/{profil2}', [\App\Http\Controllers\profilController::class, 'changepassword'])->name('changepassword');

     //thajar
     Route::resource('/thajar', \App\Http\Controllers\ThajarController::class);

});

Route::group(['prefix' => 'dashboard','middleware'=>['web','auth','ceklevel:admin']],function(){

    //studi
    // Route::get('/studi/select',[\App\Http\Controllers\StudiController::class, 'select'])->name('studi.select');
    Route::resource('/studi', \App\Http\Controllers\StudiController::class);

    //guru
    Route::resource('/guru', \App\Http\Controllers\guruController::class);

   

    //kelas
     Route::PATCH('/naikkelas/{kela}', [\App\Http\Controllers\kelasController::class,'naikkelas'])->name('kelas.naikkelas');
    Route::get('/kelas/printpdf/{kela}', [\App\Http\Controllers\kelasController::class,'print'])->name('kelas.printpdf');
    Route::resource('/kelas', \App\Http\Controllers\kelasController::class);
   
    //SISWA
    Route::resource('/siswa', \App\Http\Controllers\siswaController::class);

    //jadwal
    Route::resource('/jadwal', \App\Http\Controllers\jadwalController::class);
    Route::get('/jadwal/printpdf/{jadwal}', [\App\Http\Controllers\jadwalController::class,'print'])->name('jadwal.printpdf');

    

    //matkulkelas
    Route::resource('/matkulkelas', \App\Http\Controllers\matkulkelasController::class);
});

Route::group(['prefix' => 'dashboard','middleware'=>['web','auth','ceklevel:guru']],function(){
   
    //lihatjadwal
    Route::resource('/lihatjadwal', \App\Http\Controllers\lihatjadwalController::class);
    Route::get('/download/{materi}', [\App\Http\Controllers\lihatjadwalController::class, 'download'])->name('download');
   
    //materipengumuman
    Route::resource('/pengumuman', \App\Http\Controllers\pengumumanController::class);

    //materi 
    Route::resource('/materi', \App\Http\Controllers\materiController::class);

    //tugas 
    Route::PATCH('/all/{tuga}', [\App\Http\Controllers\tugasController::class,'all'])->name('tugas.all');
    Route::resource('/tugas', \App\Http\Controllers\tugasController::class);
    
    Route::get('/downloadtugas/{tuga}', [\App\Http\Controllers\tugasController::class, 'downloadtugas'])->name('downloadtugas');

    //tugassiswa
    Route::resource('/nilai', \App\Http\Controllers\nilaiController::class);

    //arsip
    Route::resource('/arsipmateri', \App\Http\Controllers\arsipmateriController::class);
    
    
});
Route::group(['prefix' => 'dashboard','middleware'=>['web','auth','ceklevel:siswa']],function(){

    //jadwalsiswa
    Route::resource('/jadwalsiswa', \App\Http\Controllers\jadwalsiswaController::class);

    //pengumumansiswa
    Route::resource('/pengumumansiswa', \App\Http\Controllers\pengumumansiswaController::class);

    
    //tugassiswa
    Route::resource('/tugassiswa', \App\Http\Controllers\tugassiswaController::class);

    Route::get('/download/{materi}', [\App\Http\Controllers\lihatjadwalController::class, 'download'])->name('download');

  
});