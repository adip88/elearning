<?php

namespace App\Http\Controllers;

use App\Models\studi;
use App\Models\guru;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class studiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $studi=studi::onlyParent()->with('descendant')->get();
        // $studi=studi::with('descendant');
        // if ($request->has('keyword') && trim($request->keyword)) {
        //     $studi->search($request->keyword);
        // }else{
        //     $studi->onlyParent();
        // }

        $studi=studi::when($request->keyword,function($query)use($request){
            $query->where('studi','LIKE',"%{$request->keyword}%");
        });

        return view('studi.index',[
            'studi' => $studi->paginate(10)
        ]);
    }

    // public function select(Request $request)
    // {
    //     $studi=[];
    //     if ($request->has('q')) {
    //         $search=$request->q;
    //         $studi=studi::select('id','studi')->where('studi','LIKE',"%$search%")->limit(6)->get();
    //     }else{
    //         $studi=studi::select('id','studi')->onlyParent()->limit(6)->get();
    //     }
    //     return response()->json($studi);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studi.create');
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
            'studi'=>'required|string|max:60|unique:studi'
        ]);
        
     
        $studi = new studi;
        $studi->studi=$request->studi;
        
        $studi->save();
        Alert::success('Tambah Studi', 'Berhasil');
        return redirect()->route('studi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\studi  $studi
     * @return \Illuminate\Http\Response
     */
    public function show(studi $studi)
    {
        $guru = DB::table('guru_studi')
            ->join('users', 'guru_studi.guru_id', '=', 'users.id')
            ->join('studi', 'guru_studi.studi_id', '=', 'studi.id')
            ->select('guru_studi.*', 'users.name', 'users.email')
            ->where('studi.studi','=',$studi->studi)
            ->where('users.status','=','aktif')
            ->get();

        $count=count($guru);
        return view('studi.show',compact('studi','count'),[
            'guru' => $guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\studi  $studi
     * @return \Illuminate\Http\Response
     */
    public function edit(studi $studi)
    {
        return view('studi.edit',compact('studi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\studi  $studi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studi $studi)
    {
        $request->validate([
            'studi'=>'required|string|max:60|unique:studi'
        ]);

        studi::where('id', $studi->id)
                ->update([
            'studi' =>$request->studi,
            ]);
            Alert::success('Edit Studi', 'Berhasil');
            return redirect()->route('studi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studi  $studi
     * @return \Illuminate\Http\Response
     */
    public function destroy(studi $studi)
    {
        $studi->delete();
        Alert::success('Hapus Studi', 'Berhasil');
        return redirect()->back();
        
    }
}
