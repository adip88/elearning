<?php

namespace App\Http\Controllers;

use App\Models\guru;

use App\Models\profile;
use App\Models\studi;
use App\Models\Thajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class profilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if (Auth::user()->level=='guru') {
            $user = DB::table('users')
            ->join('guru', 'users.guru_id', '=', 'guru.id')
            ->where('users.id','=', Auth::user()->id)->first();
            return view('profil.index',[
                'user'=>$user,
                
            ]);
        }elseif(Auth::user()->level=="siswa"){
            $user = DB::table('users')
            ->join('siswa', 'users.siswa_id', '=', 'siswa.id')
            ->where('users.id','=', Auth::user()->id)->first();
            $th=Thajar::all()->last();
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
            ->select('tugas.id','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->where('thajar_id',$th->id)
            ->orderBy('tugas.created_at','desc')
            ->get();

            return view('profil.index',[
                'user'=>$user,
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas
                
            ]);
        }else {
            $user = DB::table('users')
            ->where('users.id','=', Auth::user()->id)->first();
            return view('profil.index',[
                'user'=>$user,
                
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
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
        ->get();

        return view('profil.change-password',[
            'pengumuman1'=>$pengumuman,
            'tugas1'=>$tugas
            
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        if(Auth::user()->level=="siswa"){
            $user = DB::table('users')
            ->join('siswa', 'users.siswa_id', '=', 'siswa.id')
            ->where('siswa_id',$id)->first();
            $th=Thajar::all()->last();
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
            ->select('tugas.id','studi','kelas','nama_kelas')
            ->where('siswa.id',Auth::user()->siswa_id)
            ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
            ->where('thajar_id',$th->id)
            ->orderBy('tugas.created_at','desc')
            ->get();

            return view('profil.edit', compact('user'),[
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas
                
            ]);
        }elseif(Auth::user()->level=="guru"){
            $user = DB::table('users')
            ->join('guru', 'users.guru_id', '=', 'guru.id')
            ->where('guru_id',$id)->first();
            return view('profil.edit', compact('user'));
        }elseif(Auth::user()->level=="admin"){
            $user = DB::table('users')->where('level','admin')->first();
            return view('profil.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       if ($request->email==Auth::user()->email) {
                if(Auth::user()->level=="admin"){
                    $validatedData = $request->validate([
                        'email' => 'required|email|max:255|unique:users',
                        ]);
                }else {
                    $validatedData = $request->validate([
                        'email' => 'required|email|max:255|unique:users',
                        'alamat' => 'required|max:255',
                        'no_hp' => 'required|max:13',
                    ]);
                }
       }else {
                if(Auth::user()->level=="admin"){
                    $validatedData = $request->validate([
                        'email' => 'required|email|max:255',
                        ]);
                }else {
                    $validatedData = $request->validate([
                        'email' => 'required|email|max:255',
                        'alamat' => 'required|max:255',
                        'no_hp' => 'required|max:13',
                    ]);
                }
       }
        

        if(Auth::user()->level=="admin"){
            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                ]);
        }else {
            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'alamat' => 'required|max:255',
                'no_hp' => 'required|max:13',
            ]);
        }

        if(Auth::user()->level=="siswa"){
            DB::table('users')->where('siswa_id', $id)
            ->update([
                'email' =>$request->email,
            ]);
            DB::table('siswa')->where('id', $id)
            ->update([
                'no_hp' =>$request->no_hp,
                'alamat' =>$request->alamat,
            ]);
        }elseif (Auth::user()->level=="guru") {
            DB::table('users')->where('guru_id', $id)
            ->update([
                'email' =>$request->email,
            ]);
            DB::table('guru')->where('id', $id)
            ->update([
                'no_hp' =>$request->no_hp,
                'alamat' =>$request->alamat,
            ]);
        }else {
            DB::table('users')->where('level', 'admin')
            ->update([
                'email' =>$request->email,
            ]);
            
        }
        
             Alert::success('Edit Profil', 'Berhasil');
             return redirect()->route('profil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changepassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|max:255|min:8',
            'password2' => 'required|max:255|min:8',
        ]);
        $th=Thajar::all()->last();
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
        ->select('tugas.id','studi','kelas','nama_kelas')
        ->where('siswa.id',Auth::user()->siswa_id)
        ->where('tgl_terakhir','>',date("Y-m-d h:i:sa"))
        ->where('thajar_id',$th->id)
        ->orderBy('tugas.created_at','desc')
        ->get();

       

        if ($request->password==$request->password2) {
            DB::table('users')->where('id', Auth::user()->id)
             ->update([
                 'password' =>bcrypt($request->password)
             ]);
             Alert::success('Edit Password', 'Berhasil');
            return redirect()->route('profil.index',[
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas
            ]);
        }
        else {
            Alert::error('Password dan Confirm Password tidak sama');
            return view('profil.change-password',[
                'pengumuman1'=>$pengumuman,
                'tugas1'=>$tugas
            ]);
        }

        

        
    }
}
