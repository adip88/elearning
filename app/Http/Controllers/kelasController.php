<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\jadwal;
use App\Models\matkulkelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas=kelas::when($request->keyword,function($query)use($request){
            $query->where('nama_kelas','LIKE',"%{$request->keyword}%");
        });


        return view('kelas.index',[
            'kelas' => $kelas->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
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
             'nama_kelas'=>'required|string|unique:kelas',
             'deskripsi'=>'required|string|max:50'
        ]);
        
        
        foreach($request->kelas as $key => $value)
        {
            $kelas = new kelas;    
            $kelas->nama_kelas =$request->nama_kelas;
            $kelas->kelas =$value;
            $kelas->deskripsi =$request->deskripsi;
            $kelas->save();
        }
        Alert::success('Tambah kelas', 'Berhasil');
        return redirect()->route('kelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kela)
    {
        $siswa=siswa::all()->where('kelas_id','=',$kela->id);
        $count=count($siswa);
        return view('kelas.show',compact('kela','count'),[
            'siswa' => $siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas $kela)
    {
        
        $request->validate([
            'nama_kelas'=>'required|string|unique:kelas|max:60',
            'deskripsi'=>'required|string|max:50'
        ]);
        
        
        kelas::where('nama_kelas', $kela->nama_kelas)
                ->update([
            'nama_kelas' =>$request->nama_kelas,
            'deskripsi' =>$request->deskripsi,
            ]);
            Alert::success('Edit kelas', 'Berhasil');
            return redirect()->route('kelas.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        try {
            kelas::where('nama_kelas', $kela->nama_kelas)->delete();
            Alert::success('Hapus Kelas', 'Berhasil');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Hapus Studi Gagal', 'Karena di dalam kelas'.$kela->kelas.$kela->nama_kelas.'masih memiliki siswa');
            return redirect()->back();
        }
        
    }

    public function print($id)
    {
        $jadwal1=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.studi_id', '=', 'kelas.id')
            ->select('jadwal2.id','name','studi','jam_mulai','jam_selesai','hari','kelas','nama_kelas')
            ->orderBy('jam_mulai','asc')
            ->get();
        dd($jadwal1);
        return view('kelas.printpdf',[
           'jadwal'=>$jadwal
        ]);
    }
    public function naikkelas(Request $request, kelas $kela)
    {
            if ($kela->kelas=='XII') {
                
                DB::table('siswa')->where('kelas_id',$kela->id)->delete();
                 Alert::success('Naik Kelas', 'Berhasil');
                 return redirect()->route('kelas.index');
            }else {
                siswa::where('kelas_id', $kela->id)
                     ->update([
                 'kelas_id' =>$kela->id+1,
                 ]);
                 Alert::success('Naik Kelas', 'Berhasil');
                 return redirect()->route('kelas.index');
            }
    }
}
