<?php

namespace App\Http\Controllers;

use App\Models\jadwalsiswa;
use App\Models\jawaban;

use App\Models\lihatjadwal;
use App\Models\jadwal;
use App\Models\pengumuman;
use App\Models\Thajar;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\guru;
use App\Models\studi;
use App\Models\materi;
use App\Models\tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use File;
use Illuminate\Support\Facades\Auth;

class jadwalsiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Thajar $thajar,Request $request,jadwalsiswa $jadwalsiswa)
    {
        $thajar=Thajar::all();
        $th=Thajar::all()->last();
            $jadwalguru=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('jadwal2.id','guru.name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('thajar_id',$th->id)
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
            return view('thajar.index',compact('th'),[
                'jadwal'=>$jadwalguru,
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas,
                'thajar'=>$thajar
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(jadwalsiswa $jadwalsiswa,Thajar $thajar)
    {
        $th=Thajar::all()->last();
        $id=$jadwalsiswa->id;
        $jadwal=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('jadwal2.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas','jadwal2.matkulkelas_id')
        ->where('jadwal2.id',$id)
        ->get();

        $detail=jadwal::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id);
        

        $materi=materi::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id);
        $pengumuman=pengumuman::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('tgl_terakhir','>',date("Y-m-d h:i:sa"));
        $tugas=tugas::all()
        ->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"));

        $tugasselesai=tugas::all()
        ->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)
        ->where('tgl_terakhir','<',date("Y-m-d h:i:sa"));

      
        

        $pengumuman1=DB::table('pengumuman')
        ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman') 
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->get();

        $tugas1=DB::table('tugas')
        ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('tugas.id','studi','kelas','nama_kelas')
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->orderBy('tugas.created_at','desc')
        ->get();
        return view('jadwalsiswa.create',[
            'lihatjadwal'=>$jadwal,
            'materi'=>$materi,
            'pengumuman'=>$pengumuman,
            'tugas'=>$tugas,
            'pengumuman1'=>$pengumuman1,
            'tugas1'=>$tugas1,
            'detail'=>$detail,
            'tugasselesai'=>$tugasselesai,
            
        ]);
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
     * @param  \App\Models\jadwalsiswa  $jadwalsiswa
     * @return \Illuminate\Http\Response
     */
    public function show(jadwalsiswa $jadwalsiswa)
    {
        $th=Thajar::all()->last();
        $id=$jadwalsiswa->id;
        $jadwal=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('jadwal2.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas','jadwal2.matkulkelas_id')
        ->where('jadwal2.id',$id)
        ->where('thajar_id',$th->id)
        ->get();

        $detail=jadwal::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('thajar_id',$th->id);
        

        $materi=materi::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('thajar_id',$th->id);
        $pengumuman=pengumuman::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id);
        $tugas=tugas::all()
        ->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id);

        $tugasselesai=tugas::all()
        ->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)
        ->where('tgl_terakhir','<',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id);

      
        

        $pengumuman1=DB::table('pengumuman')
        ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman') 
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->get();

        $tugas1=DB::table('tugas')
        ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('tugas.id','studi','kelas','nama_kelas')
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->orderBy('tugas.created_at','desc')
        ->get();
        return view('jadwalsiswa.show',[
            'lihatjadwal'=>$jadwal,
            'materi'=>$materi,
            'pengumuman'=>$pengumuman,
            'tugas'=>$tugas,
            'pengumuman1'=>$pengumuman1,
            'tugas1'=>$tugas1,
            'detail'=>$detail,
            'tugasselesai'=>$tugasselesai,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwalsiswa  $jadwalsiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwalsiswa $jadwalsiswa,Thajar $thajar)
    {
        
        $th=Thajar::all()->first();
        $id=$jadwalsiswa->id;
        
        $jadwal=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('jadwal2.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas','jadwal2.matkulkelas_id')
        ->where('jadwal2.id',$id)
        ->where('thajar_id',$th->id)
        ->get();

        $detail=jadwal::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('thajar_id',$th->id);
        

        $materi=materi::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('thajar_id',$th->id);
        $pengumuman=pengumuman::all()->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)->where('tgl_terakhir','>',date("Y-m-d h:i:sa"));
      

        $tugasselesai=tugas::all()
        ->where('matkulkelas_id',$jadwal[0]->matkulkelas_id)
        ->where('tgl_terakhir','<',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id);;

      
        

        $pengumuman1=DB::table('pengumuman')
        ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman') 
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->get();

        $tugas1=DB::table('tugas')
        ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('tugas.id','studi','kelas','nama_kelas')
        ->where('siswa.id',Auth::user()->siswa_id)->where('thajar_id',$th->id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->orderBy('tugas.created_at','desc')
        ->get();
        return view('jadwalsiswa.create',[
            'lihatjadwal'=>$jadwal,
            'materi'=>$materi,
            'pengumuman'=>$pengumuman,
            'pengumuman1'=>$pengumuman1,
            'tugas1'=>$tugas1,
            'detail'=>$detail,
            'tugasselesai'=>$tugasselesai,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jadwalsiswa  $jadwalsiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jadwalsiswa $jadwalsiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwalsiswa  $jadwalsiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwalsiswa $jadwalsiswa)
    {
        //
    }
}
