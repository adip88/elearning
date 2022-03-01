<?php

namespace App\Http\Controllers;

use App\Models\pengumuman;
use App\Models\matkulkelas;
use App\Models\kelas;
use App\Models\Thajar;
use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Auth;
class pengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $th=Thajar::all()->last();
        $pengumuman=pengumuman::all()
        ->where('guru_id','=',Auth::user()->guru_id)
        ->where('thajar_id',$th->id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"));
        
        return view('pengumuman.index',[
            'pengumuman'=>$pengumuman,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $th=Thajar::all()->last();
        $jadwal=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('matkulkelas.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas')
        ->where('guru.id',Auth::user()->guru_id)
        ->where('thajar_id',$th->id)
        ->orderBy('jam_mulai','asc')
        ->get();
        return view('pengumuman.create',[
            'jadwal'=>$jadwal
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
        $request->validate([
            'pengumuman'=>'required|max:255',
            'jadwal'=>'required ',
            'tgl_terakhir'=>'required '
       ]);
       $th=Thajar::all()->last();
            $hapus=pengumuman::all()
            ->where('guru_id',Auth::user()->guru_id)
            ->where('matkulkelas_id',$request->jadwal);

            
            if ($hapus->count()>0) {
                DB::table('pengumuman')
                ->where('guru_id',Auth::user()->guru_id)
                ->where('matkulkelas_id',$request->jadwal)
                ->delete();
            }
            $pengumuman = new pengumuman;    
            $pengumuman->pengumuman=$request->pengumuman;
            $pengumuman->matkulkelas_id =$request->jadwal;
            $pengumuman->guru_id =Auth::user()->guru_id;
            $pengumuman->tgl_terakhir =$request->tgl_terakhir;
            $pengumuman->thajar_id=$th->id;
            $pengumuman->save();

            
            Alert::success('Tambah Pengumuman', 'Berhasil');
            return redirect()->route('pengumuman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(pengumuman $pengumuman)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(pengumuman $pengumuman)
    {
        $th=Thajar::all()->last();
        $jadwal = jadwal::all()
        ->where('guru_id',Auth::user()->guru_id)->where('thajar_id',$th->id);
        return view('pengumuman.edit',compact('pengumuman'),[
             'jadwal'=>$jadwal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pengumuman $pengumuman)
    {
        $request->validate([
            'pengumuman'=>'required|max:255',
            'jadwal'=>'required ',
            'tgl_terakhir'=>'required '
       ]);
       pengumuman::where('id', $pengumuman->id)
                ->update([
            'pengumuman' =>$request->pengumuman,
            'matkulkelas_id'=>$request->jadwal,
            'tgl_terakhir' =>$request->tgl_terakhir,
            ]);
            Alert::success('Edit Pengumuman', 'Berhasil');
            return redirect()->route('pengumuman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengumuman $pengumuman)
    {
        $pengumuman->delete();
        Alert::success('Hapus pengumuman', 'Berhasil');
        return redirect()->back();
    }
}
