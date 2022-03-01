<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\Thajar;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\matkulkelas;
use App\Models\guru;
use App\Models\studi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class jadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas=kelas::all();
       
        $th=Thajar::all()->last();

        return view('jadwal.index',[
            'kelas' => $kelas,
            'th'=>$th
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'guru'=>'required',
            'jam_mulai'=>'required',
            'jam_selesai'=>'required',
            'hari'=>'required',
            'matkulkelas'=>'required',
        ]);
        $th=Thajar::all()->last();
        $jadwal= new jadwal;
        $jadwal->matkulkelas_id =$request->matkulkelas;
        $jadwal->guru_id =$request->guru;
        $jadwal->jam_mulai =$request->jam_mulai;
        $jadwal->jam_selesai =$request->jam_selesai;
        $jadwal->hari =$request->hari;
        $jadwal->thajar_id =$th->id;
        $jadwal->save();
        Alert::success('Tambah Jadwal', 'Berhasil');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($jadwal)
    {
        $th=Thajar::all()->last();
        $kelas=kelas::all()->where('id',$jadwal);
        $matkulkelas=matkulkelas::all()->where('kelas_id',$jadwal);
        $guru=guru::all();

        $jadwal1=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->select('jadwal2.id','name','studi','jam_mulai','jam_selesai','hari')
            ->where('kelas_id',$jadwal)
            ->where('thajar_id',$th->id)
            ->orderBy('jam_mulai','asc')
            ->get();

        return view('jadwal.show',[
            'kelas'=>$kelas,
            'matkulkelas'=>$matkulkelas,
            'guru'=>$guru,
            'jadwal'=>$jadwal1,
            'th'=>$th
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        $matkulkelas=matkulkelas::all();
        $jadwal1=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('jadwal2.id','matkulkelas.kelas_id')
        ->first();
        return view('jadwal.edit', compact('jadwal'),[
            'matkulkelas'=>$matkulkelas,
            'jadwal1'=>$jadwal1,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jadwal $jadwal)
    {
        $request->validate([
            'mapelkelas'=>'required',
            'jam_mulai'=>'required',
            'jam_selesai'=>'required',
            'hari'=>'required',
        ]);

        jadwal::where('id', $jadwal->id)
                ->update([
            'hari' =>$request->hari,
            'jam_mulai' =>$request->jam_mulai,
            'jam_selesai' =>$request->jam_selesai,
            'matkulkelas_id' =>$request->mapelkelas,
            ]);
            Alert::success('Edit Jadwal', 'Berhasil');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $jadwal)
    {
        $jadwal->delete();
        Alert::success('Hapus Guru', 'Berhasil');
        return back();
    }
  public function print($id)
    {
        $jadwal=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->where('kelas.id',$id)
            ->orderBy('jam_mulai','asc')
            ->get();
        $kelas=kelas::all()->where('id',$id);
        return view('jadwal.printpdf',[
           'jadwal'=>$jadwal,
           'kelas'=>$kelas
        ]);
    }
    
}
