<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\user;
use App\Models\kelas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash; 

use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $siswa=siswa::when($request->keyword,function($query)use($request){
            $query->where('name','LIKE',"%{$request->keyword}%");
        })->orderBy('created_at','desc');


        return view('siswa.index',[
            'siswa' => $siswa->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas=kelas::all()->where('kelas','=','X');
        
        
        return view('siswa.create',compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'email||unique:users|required|max:255',
                'jenis_kelamin' => 'required',
                'alamat' => 'required|max:255',
                'no_hp' => 'required|max:13',
                'agama' => 'required',
                'kelas' => 'required',
                'tgl_lahir' => 'required|max:50',
                'tempat_lahir' => 'required',
                'nis' => 'required|max:4|unique:siswa',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
    
            // if ($ceksiswa<100){
            //     $no='00'+$ceksiswa;
            // }elseif($ceksiswa<1000){
            //     $no='000'+$ceksiswa;
            // }            

            $siswa = new siswa;
            $siswa->name =$request->name;
            $siswa->jenis_kelamin=$request->jenis_kelamin;
            $siswa->alamat=$request->alamat;
            $siswa->tahun_masuk=date('Y');
            $siswa->no_hp=$request->no_hp;
            $siswa->kelas_id=$request->kelas;
            $siswa->agama=$request->agama;
            $siswa->tgl_lahir=$request->tgl_lahir;
            $siswa->tempat_lahir=$request->tempat_lahir;
            $siswa->nis=$request->nis;
            
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('img'), $imageName);

            $siswa->image=$imageName;
    
            $siswa->save();

            
           
            $idsiswa=siswa::orderBy('id', 'DESC')->first();
            $ceksiswa=$idsiswa['id'];
            
    
            $user = new user;
            $user->siswa_id = $ceksiswa;
            $user->email =$request->email;
            $user->level ='siswa';
            $user->password =bcrypt('12345678');
            $user->save();

            Alert::success('Tambah siswa', 'Berhasil');
            return redirect()->route('siswa.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(siswa $siswa)
    {
        $kelas=kelas::all();
        return view('siswa.show',compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(siswa $siswa)
    {
        $kelas=kelas::all();
        return view('siswa.edit',compact('siswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswa $siswa)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|max:255',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:13',
            'agama' => 'required',
            'kelas' => 'required',
            'tgl_lahir' => 'required|max:50',
            'tempat_lahir' => 'required',
            'nis' => 'required|max:4',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if (!empty($request->image)) {
            File::delete(public_path('img/'.$siswa->image));
            siswa::where('id', $siswa->id)
                ->update([
            'name' =>$request->name,
            'nis'=>$request->nis,
            'jenis_kelamin' =>$request->jenis_kelamin,
            'alamat' =>$request->alamat,
            'no_hp'=>$request->no_hp,
            'agama'=>$request->agama,
            'image' =>$request->image,
            'tgl_lahir'=>$request->tgl_lahir,
            'tempat_lahir'=>$request->tempat_lahir,
            'kelas_id'=>$request->kelas,
            
        ]);
                    
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('img'), $imageName); 
            $siswa->image=$imageName;
            $siswa->save();
        }
        else {
            siswa::where('id', $siswa->id)
            ->update([
        'name' =>$request->name,
        'jenis_kelamin' =>$request->jenis_kelamin,
        'nis'=>$request->nis,
        'alamat' =>$request->alamat,
        'no_hp'=>$request->no_hp,
        'agama'=>$request->agama,
        'tgl_lahir'=>$request->tgl_lahir,
        'tempat_lahir'=>$request->tempat_lahir,
        'kelas_id'=>$request->kelas,
    ]);
        }

        
        $user=DB::table('users')->where('siswa_id',$siswa->id)
                                ->update(['email'=>$request->email]);

        Alert::success('Edit Siswa', 'Berhasil');
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        File::delete(public_path('img/'.$siswa->image));
        $siswa->delete();
        DB::table('users')->where('siswa_id',$siswa)->delete();
        Alert::success('Hapus Siswa', 'Berhasil');
        return redirect()->back();
    }
}
