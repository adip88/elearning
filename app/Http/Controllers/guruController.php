<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;

class guruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guru=guru::when($request->keyword,function($query)use($request){
            $query->where('name','LIKE',"%{$request->keyword}%");
        })->orderBy('created_at','desc');

        return view('guru.index',[
            'guru' => $guru->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.create' );
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
            'tgl_lahir' => 'required|max:50',
            'tempat_lahir' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                    ]);

                    
        
        $guru = new guru;
        $guru->name =$request->name;
        $guru->jenis_kelamin=$request->jenis_kelamin;
        $guru->alamat=$request->alamat;
        $guru->tahun_masuk=date('Y');;
        $guru->no_hp=$request->no_hp;
        $guru->agama=$request->agama;
        $guru->tgl_lahir=$request->tgl_lahir;
        $guru->tempat_lahir=$request->tempat_lahir;
        
        


        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        $guru->image=$imageName;

       

        $guru->save();

        $idguru=guru::orderBy('id', 'DESC')->first();
        $cekguru=$idguru['id'];
        

        $user = new user;
        $user->guru_id = $cekguru;
        $user->email =$request->email;
        $user->level ='guru';
        $user->password =bcrypt('12345678');
        $user->save();
      

        Alert::success('Tambah guru', 'Berhasil');
        return redirect()->route('guru.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(guru $guru)
    {
        return view('guru.show',compact('guru') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(guru $guru)
    {
       
        return view('guru.edit',[
            'guru'=>$guru
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, guru $guru)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|max:255',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:13',
            'agama' => 'required',
            'tgl_lahir' => 'required|max:50',
            'tempat_lahir' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if (!empty($request->image)) {
            File::delete(public_path('img/'.$guru->image));
         $guru->update([
            'name' =>$request->name,
            'jenis_kelamin' =>$request->jenis_kelamin,
            'alamat' =>$request->alamat,
            'no_hp'=>$request->no_hp,
            'agama'=>$request->agama,
            'tgl_lahir'=>$request->tgl_lahir,
            'tempat_lahir'=>$request->tempat_lahir,            
        ]);
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('img'), $imageName); 
            $guru->image=$imageName;
            $guru->save();
        }else{
            $guru->update([
                'name' =>$request->name,
                'jenis_kelamin' =>$request->jenis_kelamin,
                'alamat' =>$request->alamat,
                'no_hp'=>$request->no_hp,
                'agama'=>$request->agama,
                'tgl_lahir'=>$request->tgl_lahir,
                'tempat_lahir'=>$request->tempat_lahir,            
            ]);
        } 

        $user=DB::table('users')->where('guru_id',$guru->id)
                                ->update(['email'=>$request->email]);

        Alert::success('Edit guru', 'Berhasil');
        return redirect()->route('guru.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(guru $guru)
    {
        File::delete(public_path('img/'.$guru->image));
        $guru->delete();
        DB::table('users')->where('guru_id',$guru)->delete();
        Alert::success('Hapus Guru', 'Berhasil');
        return redirect()->back();
    }
}
