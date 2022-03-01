<?php

namespace App\Http\Controllers;

use App\Models\nilai;
use App\Models\jawaban;
use App\Models\tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use ZipArchive;
use File;
class nilaiController extends Controller
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
     * @param  \App\Models\nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(nilai $nilai)
    {
        return response()->download(public_path('jawaban/'.$nilai->jawaban));

        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(nilai $nilai)
    {
        foreach ($jawaban as $key => $value) {
            try {
                File::copy(public_path('jawaban/'.$value->jawaban),public_path('download/'.$value->jawaban));
            } catch (\Throwable $th) {
                
            }
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nilai $nilai)
    {
        $validatedData = $request->validate([
            'nilai' => 'required|int|max:100|min:0',
        ]);

         DB::table('jawaban')->where('id', $nilai->id)
             ->update([
                 'nilai' =>$request->nilai,
             ]);
             Alert::success('Tambah Nilai', 'Berhasil');
             return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(nilai $nilai)
    {
        //
    }
}
