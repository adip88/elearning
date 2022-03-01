<?php

namespace App\Http\Controllers;

use App\Models\tugassiswa;
use App\Models\jawaban;
use App\Models\Thajar;
use App\Models\siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class tugassiswaController extends Controller
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tugassiswa  $tugassiswa
     * @return \Illuminate\Http\Response
     */
    public function show(tugassiswa $tugassiswa)
    {
        $th=Thajar::all()->last();
        $pengumuman=DB::table('pengumuman')
        ->join('matkulkelas', 'pengumuman.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
        ->select('pengumuman.id','studi','kelas','nama_kelas','pengumuman')
        ->where('siswa.id',Auth::user()->siswa_id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->orderBy('pengumuman.created_at','desc')
        ->where('thajar_id',$th->id)
        ->get();

        $tugas=DB::table('tugas')
            ->join('matkulkelas', 'tugas.matkulkelas_id', '=', 'matkulkelas.id')
            ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
            ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
            ->join('siswa', 'siswa.kelas_id', '=', 'kelas.id')
            ->select('tugas.id','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->orderBy('tugas.created_at','desc')
            ->where('thajar_id',$th->id)
            ->get();

            $jawaban=jawaban::all()->where('tugas_id',$tugassiswa->id)->where('siswa_id',Auth::user()->siswa_id)->first();
            $jawaban1=jawaban::all()->where('tugas_id',$tugassiswa->id)->where('siswa_id',Auth::user()->siswa_id)->count();
        return view('jadwalsiswa.tugas',compact('tugassiswa'),[
            'pengumuman1'=>$pengumuman,
            'tugas1'=>$tugas,
            'jawaban'=>$jawaban
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tugassiswa  $tugassiswa
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
     * @param  \App\Models\tugassiswa  $tugassiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tugassiswa $tugassiswa)
    {
        $jawaban=jawaban::all()->where('tugas_id',$tugassiswa->id)->where('siswa_id',Auth::user()->siswa_id)->first();
        $siswa=siswa::all()->where('id',Auth::user()->siswa_id)->first();
        if ($jawaban->text=='0') {
            $request->validate([
                'jawaban'=>'required',
           ]);
           
             $imageName = time().'_'.$siswa->name.'.'.$request->jawaban->extension();
    
            $request->jawaban->move(public_path('jawaban'), $imageName);
    
           jawaban::where('id', $jawaban->id)
                    ->update([
                        'jawaban'=>$imageName,
                    ]);
        }
            Alert::success('Tambah tugas', 'Berhasil');
            return redirect()->back();
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tugassiswa  $tugassiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(tugassiswa $tugassiswa)
    {
        //
    }
}
