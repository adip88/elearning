<?php

namespace App\Http\Controllers;

use App\Models\tugas;
use App\Models\siswa;
use App\Models\jawaban;
use App\Models\matkulkelas;
use App\Models\kelas;
use App\Models\Thajar;
use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use File;
use ZipArchive;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class tugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $th=Thajar::all()->last();
        $aktif=tugas::all()->where('guru_id','=',Auth::user()->guru_id)->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id);

        $nonaktif=tugas::
        where('guru_id','=',Auth::user()->guru_id)->where('tgl_terakhir','<',date("Y-m-d h:i:sa"))->where('thajar_id',$th->id)->paginate(15);

        return view('tugas.index',[
            'aktif'=>$aktif,
            'nonaktif'=>$nonaktif
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
        // $jadwal=DB::table('jadwal2')
        // ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        // ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        // ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        // ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        // ->select('matkulkelas.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas','matkulkelas.kelas_id')
        // ->where('guru.id',Auth::user()->guru_id)
        // ->where('thajar_id',$th->id)
        // ->orderBy('jam_mulai','asc')
        // ->get();

        $jadwal=DB::table('jadwal2')
        ->join('matkulkelas', 'jadwal2.matkulkelas_id', '=', 'matkulkelas.id')
        ->join('guru', 'jadwal2.guru_id', '=', 'guru.id')
        ->join('studi', 'matkulkelas.studi_id', '=', 'studi.id')
        ->join('kelas', 'matkulkelas.kelas_id', '=', 'kelas.id')
        ->select('matkulkelas.id','name','hari','jam_mulai','jam_selesai','studi','kelas','nama_kelas','matkulkelas.kelas_id')
        ->where('guru.id',Auth::user()->guru_id)
        ->where('thajar_id',$th->id)
        ->orderBy('jam_mulai','asc')
        ->get();
        return view('tugas.create',[
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
             'tugas'=>'required|max:255',
             'jadwal'=>'required ',
             'tgl_terkahir'=>'requierd',
        ]);
        $th=Thajar::all()->last();
        $tugas = new tugas;    
        $tugas->tugas=$request->tugas;
        $tugas->matkulkelas_id =$request->jadwal;
        $tugas->tgl_terakhir =$request->tgl_terakhir;
        $tugas->guru_id =auth()->user()->guru_id;
        $tugas->judul =$request->judul;
        $tugas->thajar_id =$th->id;

        if ($request->konten==!null) {
         $imageName = time().'.'.$request->konten->extension();

         $request->konten->move(public_path('tugas'), $imageName);
 
         $tugas->konten=$imageName;
        }

        $tugas->save();
    

        
        $baru=tugas::all()->last();
        $kelas=matkulkelas::all()->where('id',intval($request->jadwal))->first();
        $siswa1=siswa::all()->where('kelas_id',$kelas->kelas_id);

            foreach ($siswa1 as $key => $value) {
                 $jawaban = new jawaban; 
                 $jawaban->tugas_id=$baru->id;
                 $jawaban->siswa_id =$value->id;
                //  if ($request->tipe==1) {
                //     $jawaban->text =0;
                // } else {
                //     $jawaban->jawaban=0;
                // }
                 $jawaban->save();
            }

       
        
            
     
       


       Alert::success('Tambah Tugas', 'Berhasil');
       return redirect()->route('tugas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show(tugas $tuga)
    {
        $jawaban=jawaban::all()->where('tugas_id',$tuga->id);
        $matkulkelas=matkulkelas::all()->where('id',$tuga->matkulkelas_id);
        // $siswa=siswa::all()->where('kelas_id',$matkulkelas->kelas_id);
       
        
            
        // foreach ($jawaban as $key => $value) {
        //     try {
        //         File::copy(public_path('jawaban/'.$value->jawaban),public_path('download/'.$value->jawaban));
        //     } catch (\Throwable $th) {
                
        //     }
        // }
      

        
       

        return view('tugas.show',compact('tuga'),[
            'jawaban' => $jawaban,
            // 'siswa'=>$siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit(tugas $tuga)
    {
       
        $jadwal = jadwal::all()->where('guru_id','=',auth()->user()->guru_id);
        return view('tugas.edit',compact('tuga'),[
             'jadwal'=>$jadwal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tugas $tuga)
    {
        $request->validate([
            'tugas'=>'required|max:255',
            'jadwal'=>'required ',
            'tgl_terkahir'=>'requierd',
       ]);
       tugas::where('id', $tuga->id)
                ->update([
            'judul' =>$request->judul,
            'matkulkelas_id'=>$request->jadwal,
            'tugas'=>$request->tugas,
            'tgl_terakhir'=>$request->tgl_terakhir,
            ]);
            if ($request->konten==!'') {
                $imageName = time().'.'.$request->konten->extension();

            $request->konten->move(public_path('tugas'), $imageName);

            $tuga->konten=$imageName;
            }
            
     
            $tuga->save();
            Alert::success('Edit tugas', 'Berhasil');
            return redirect()->route('tugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(tugas $tuga)
    {
        File::delete(public_path('tugas/'.$tuga->konten));
        $tuga->delete();
        Alert::success('Hapus tugas', 'Berhasil');
        return redirect()->back();
    }

    public function downloadtugas(tugas $tuga)
    {
       

        
    }

    public function all(Request $request, tugas $tuga)
    {
        $jawaban=jawaban::all()->where('tugas_id',$tuga->id);

        foreach ($jawaban as $key => $value) {
            try {
                File::copy(public_path('jawaban/'.$value->jawaban),public_path('download/'.$value->jawaban));
            } catch (\Throwable $th) {
                
            }
        }

        $zip = new ZipArchive;
        $filename = $tuga->judul.'_'.'jawaban.zip';
        if ($zip->open(public_path($filename),ZipArchive::CREATE)==true) {
            $files = File::files(public_path('download'));
            foreach ($files as $key => $value) {
                $relativenameInZipFile = basename($value);
                $zip->addFile($value,$relativenameInZipFile);
            }
            $zip->close();
        }

        foreach ($jawaban as $key => $value) {
            try {
                File::delete(public_path('download/'.$value->jawaban));
            } catch (\Throwable $th) {
                
            }
        }
        return response()->download(public_path($filename));
    }
    
}
