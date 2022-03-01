<?php

namespace App\Http\Controllers;

use App\Models\pengumumansiswa;
use App\Models\tugassiswa;
use App\Models\Thajar;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class pengumumansiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\pengumumansiswa  $pengumumansiswa
     * @return \Illuminate\Http\Response
     */
    public function show(pengumumansiswa $pengumumansiswa)
    {
        $th=Thajar::all()->last();
        $pengumuman=DB::table('pengumuman')
        ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman')
        ->where('siswa.id',Auth::user()->siswa_id)
        ->where('thajar_id',$th->id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->orderBy('pengumuman.created_at','desc')
        ->get();

        $tugas=DB::table('tugas')
            ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('tugas.id','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('thajar_id',$th->id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->orderBy('tugas.created_at','desc')
            ->get();
        return view('jadwalsiswa.pengumuman',compact('pengumumansiswa'),[
            'pengumuman1'=>$pengumuman,
            'tugas1'=>$tugas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengumumansiswa  $pengumumansiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(tugassiswa $tugassiswa)
    {
        return response()->download(public_path('tugas/'.$tugassiswa->konten));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengumumansiswa  $pengumumansiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengumumansiswa $pengumumansiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengumumansiswa  $pengumumansiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengumumansiswa $pengumumansiswa)
    {
        //
    }
}
