<?php

namespace App\Http\Controllers;

use App\Models\arsipmateri;
use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\Thajar;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\matkulkelas;
use App\Models\guru;
use App\Models\studi;
use App\Models\materi;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class arsipmateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thajar=DB::table('thajar')
        ->orderBy('id','desc')
        ->get();

        

        return view('arsipmateri.index',[
            'thajar' => $thajar,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\arsipmateri  $arsipmateri
     * @return \Illuminate\Http\Response
     */
    public function show(arsipmateri $arsipmateri)
    {
        $materi=materi::all()->where('thajar_id',$arsipmateri->id)->where('guru_id',auth()->user()->guru_id); 
        return view('arsipmateri.show',[
            'materi' => $materi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\arsipmateri  $arsipmateri
     * @return \Illuminate\Http\Response
     */
    public function edit(arsipmateri $arsipmateri)
    {
        return view('materi.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\arsipmateri  $arsipmateri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, arsipmateri $arsipmateri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\arsipmateri  $arsipmateri
     * @return \Illuminate\Http\Response
     */
    public function destroy(arsipmateri $arsipmateri)
    {
        //
    }
}
