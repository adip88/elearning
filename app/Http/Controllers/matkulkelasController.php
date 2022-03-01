<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;
use App\Models\studi;
use App\Models\matkulkelas;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
class matkulkelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas=kelas::all();

        return view('matkulkelas.index',[
            'kelas' => $kelas,
        ]);
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
        $validatedData = $request->validate([
            'studi' => 'required',
        ]);

        $matkulkelas = new matkulkelas;
        $matkulkelas->kelas_id =$request->kelas_id;
        $matkulkelas->studi_id =$request->studi;
        $matkulkelas->save();

        Alert::success('Tambah matkulkelas', 'Berhasil');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($matkulkela)
    {
        $kelas=kelas::all()->where('id',$matkulkela);
        $studi=studi::all();
        $matkulkelas=matkulkelas::all()->where('kelas_id',$matkulkela);
        return view('matkulkelas.show',[
            'kelas'=>$kelas,
            'studi'=>$studi,
            'matkulkelas'=>$matkulkelas,
        ]);

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($matkulkela)
    {
        DB::table('matkulkelas')->where('id',$matkulkela)->delete();
        Alert::success('Hapus matkulkelas', 'Berhasil');
        return redirect()->back();
    }
}
