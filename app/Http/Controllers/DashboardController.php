<?php

namespace App\Http\Controllers;
use App\Models\jadwal;
use App\Models\pengumuman;
use App\Models\matkulkelas;
use App\Models\materi;
use App\Models\guru;
use App\Models\studi;
use App\Models\kelas;
use App\Models\Thajar;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        if ( Auth::user()->level=='admin') {
            $siswa=siswa::all()->count();
            $guru=guru::all()->count();
            $kelas=kelas::all()->count();
            $studi=studi::all()->count();
            return view('dashboard.index',compact('guru','siswa','studi','kelas'));
        }elseif( Auth::user()->level=='guru'){
            $th=Thajar::all()->last();
            $jadwalguru=DB::table('jadwal2')
            ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->select('jadwal2.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas')
            ->where('guru.id',Auth::user()->guru_id)
            ->where('thajar_id',$th->id)
            ->orderBy('jam_mulai','asc')
            ->get();
            $thajar=$th;
            $materi=materi::all()->where('guru_id','=',auth()->user()->guru_id)->where('thajar_id',$th->id);
            return view('lihatjadwal.index',compact('thajar','th'),[
                'jadwal'=>$jadwalguru,
                'materi'=>$materi
            ]);
        }elseif ( Auth::user()->level=='siswa'){
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
            return view('jadwalsiswa.index',[
                'jadwal'=>$jadwalguru,
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas,
                'th'=>$th,
            ]);
        }
    }
}
