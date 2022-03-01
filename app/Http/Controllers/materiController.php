<?php

namespace App\Http\Controllers;
use App\Http\Resources\MateriCollection;

use App\Models\materi;
use App\Models\jadwal;
use App\Models\Thajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use File;
use Illuminate\Support\Facades\Auth;

class materiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $th=Thajar::all()->last();
        $th1=DB::table('thajar')->orderBy('id','desc')->get();
        $materi=materi::where('guru_id','=',auth()->user()->guru_id)->where('thajar_id',$th->id)->paginate(15);
        return view('materi.index',compact('materi'),[
            'th1'=>$th1
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
        return view('materi.create',[
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
            'judul'=>'required|max:255',
            'jadwal'=>'required ',
            'deskripsi'=>'required||max:50'
       ]);
            $th=Thajar::all()->last();
            $materi = new materi;    
            $materi->judul=$request->judul;
            $materi->deskripsi=$request->deskripsi;
            $materi->thajar_id=$th->id;
            $materi->matkulkelas_id =$request->jadwal;
            
            $materi->guru_id =auth()->user()->guru_id;
            
            if ($request->link==!null) {
                $materi->link =$request->link;
            }
            if ($request->konten==!null) {
                $imageName = time().'.'.$request->konten->extension();

                $request->konten->move(public_path('materi'), $imageName);
    
                $materi->konten=$imageName;
            }
     
            $materi->save();
            Alert::success('Tambah Materi', 'Berhasil');
            return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(materi $materi)
    {
        return response()->download(public_path('materi/'.$materi->konten));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(materi $materi)
    {
        $th=Thajar::all()->last();
        $jadwal = jadwal::all()->where('guru_id','=',auth()->user()->guru_id)->where('thajar_id',$th->id);
        return view('materi.edit',compact('materi'),[
             'jadwal'=>$jadwal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materi $materi)
    {
        $request->validate([
            'judul'=>'required|max:255',
            'deskripsi'=>'required|max:50',
       ]);
       materi::where('id', $materi->id)
                ->update([
            'judul' =>$request->judul,
            'link'=>$request->link,
            'deskripsi'=>$request->deskripsi,
            'matkulkelas_id'=>$request->jadwal,
            ]);
            if ($request->konten==!null) {
                $imageName = time().'.'.$request->konten->extension();

                $request->konten->move(public_path('materi'), $imageName);
    
                $materi->konten=$imageName;
            }
            
            
     
           
            Alert::success('Edit Materi', 'Berhasil');
            return redirect()->route('materi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(materi $materi)
    {
        File::delete(public_path('materi/'.$materi->konten));
        $materi->delete();
        Alert::success('Hapus Materi', 'Berhasil');
        return redirect()->back();
    }
}
