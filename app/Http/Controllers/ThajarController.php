<?php

namespace App\Http\Controllers;

use App\Models\Thajar;
use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\matkulkelas;
use App\Models\guru;
use App\Models\studi;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ThajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $thajar=DB::table('thajar')
        ->orderBy('id','desc')
        ->get();

        

        return view('thajar.index',[
            'thajar' => $thajar,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thajar.create' );
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
            'tahun'=>'required||max:20',
        ]);
        $tahun= new Thajar;
        $tahun->tahun =$request->tahun;
        $tahun->save();
        Alert::success('Tambah Tahun Ajaran', 'Berhasil');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thajar  $thajar
     * @return \Illuminate\Http\Response
     */
    public function show(Thajar $thajar,Request $request)
    {
        $th=Thajar::all()->last();
        if (Auth::user()->level=='admin') {
            $kelas=kelas::all();


            $jadwal1=DB::table('jadwal2')
                ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
                ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
                ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
                ->select('jadwal2.id','name','studi','jam_mulai','jam_selesai','hari')
                ->where('thajar_id',$thajar->id)
                ->orderBy('jam_mulai','asc')
                ->when($request->keyword,function($query)use($request){
                    $query->where('kelas_id','LIKE',"%{$request->keyword}%");
                })->get();
                
            $jadwal2=DB::table('jadwal2')
                ->where('thajar_id',$thajar->id)
                ->get();
            $awal=$jadwal1->count();
            $akhir=$jadwal2->count();
    
            return view('thajar.show',compact('awal','akhir','thajar'),[
                'kelas'=>$kelas,
                'jadwal'=>$jadwal1,
            ]);
        }
        if( Auth::user()->level=='guru'){
            $jadwalguru=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->select('jadwal2.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas')
            ->where('guru.id',Auth::user()->guru_id)
            ->where('thajar_id',$thajar->id)
            ->orderBy('jam_mulai','asc')
            ->get();
            
            // $materi=materi::all()->where('guru_id','=',auth()->user()->guru_id)->where('thajar_id',$th->id);
            return view('lihatjadwal.index',compact('th','thajar'),[
                'jadwal'=>$jadwalguru,
                // 'materi'=>$materi
            ]);
        }
        if( Auth::user()->level=='siswa'){
        $th=Thajar::all()->last();
            $jadwalguru=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('jadwal2.id','guru.name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('thajar_id',$thajar->id)
            ->orderBy('jam_mulai','asc')
            ->get();

            $pengumuman=DB::table('pengumuman')
            ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->where('thajar_id',$th->id)
            ->orderBy('pengumuman.created_at','desc')
            ->get();
            

            

            $tugas=DB::table('tugas')
            ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('tugas.id','studi','kelas','nama_kelas','matkulkelas_id')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->where('thajar_id',$th->id)
            ->orderBy('tugas.created_at','desc')
            ->get();
            return view('jadwalsiswa.edit',compact('th'),[
                'jadwal'=>$jadwalguru,
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas,
                'thajar'=>$thajar
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thajar  $thajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Thajar $thajar)
    {
        
        return view('thajar.edit',compact('thajar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thajar  $thajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thajar $thajar)
    {
        $request->validate([
            'tahun'=>'required||max:20',
        ]);

        Thajar::where('id', $thajar->id)
                ->update([
            'tahun' =>$request->tahun,
            ]);
            Alert::success('Edit Tahun', 'Berhasil');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thajar  $thajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thajar $thajar)
    {
        $thajar->delete();
        Alert::success('Hapus Tahun Ajaran', 'Berhasil');
        return back();
    }
}
