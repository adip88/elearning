<?php

namespace App\Http\Controllers;

use App\Models\lihatjadwal;
use App\Models\jadwal;
use App\Models\pengumuman;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\guru;
use App\Models\studi;
use App\Models\materi;
use App\Models\Thajar;
use App\Models\tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use File;
use Illuminate\Support\Facades\Auth;

class lihatjadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lihatjadwal.create');
    }

    public function upload()
    {
        return view('upload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lihatjadwal  $lihatjadwal
     * @return \Illuminate\Http\Response
     */
    public function show(lihatjadwal $lihatjadwal)
    {
        $jadwal=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->where('jadwal2.id',$lihatjadwal->id)
            ->first();
        
        
        $siswa=siswa::all()->where('kelas_id','=',$jadwal->id);
        $count=count($siswa);
        return view('lihatjadwal.show',compact('count','lihatjadwal'),[
            'siswa' => $siswa,
        ]);
    }
    public function download(materi $materi)
    {
        return response()->download(public_path('materi/'.$materi->konten));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lihatjadwal  $lihatjadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(lihatjadwal $lihatjadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lihatjadwal  $lihatjadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lihatjadwal $lihatjadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lihatjadwal  $lihatjadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(lihatjadwal $lihatjadwal)
    {
        //
    }
}
