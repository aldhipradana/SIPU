<?php

namespace App\Http\Controllers;

use App\angsuran;
use App\nasabah;
use App\pinjaman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use PDF;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('angsuran.index');
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
        $data = [
            'idPinjaman' => $request['idPinjaman'],
            'jmlAngsuran' => $request['jmlAngsuran'],
            'keterangan' => $request['keterangan']
        ];
        
        return angsuran::create($data);
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
        $angsuran = angsuran::where('idAngsuran',$id)->first();

        return $angsuran;
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
        $angsuran = angsuran::where('idAngsuran',$id)->first();

        $angsuran->idPinjaman = $request['idPinjaman'];
        $angsuran->jmlAngsuran = $request['jmlAngsuran'];
        $angsuran->keterangan = $request['keterangan'];
        $angsuran->update();

        return $angsuran;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $angsuran = angsuran::findOrFail($id);

        angsuran::destroy($id);

        return response()->json([
            'success' => true 
        ]);
    }

    public function apiAngsuran(){
        $angsuran = angsuran::all();

        return DataTables::of($angsuran)
            ->addColumn('jml_pinjaman', function($angsuran){
                return $angsuran->pinjamans->jmlPinjam;
            })
            ->addColumn( 'action', function($angsuran){
                return '<a onclick="editForm('. $angsuran->idAngsuran .')" class="btn btn-primary btn-xs"><i class="fa fa-pen" aria-hidden="true"></i> Edit</a> ' .
                '<a onclick="deleteData('. $angsuran->idAngsuran .')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>'; 
            })->make(true);
    }
    public function getAngsuran(){
        $angsuran = angsuran::all();

        return response()->json([
            'success' => true,
            'data' => $angsuran
        ]);
    }
    public function exportPDF(){
        $angsurans = angsuran::all();
        
        $pdf = PDF::loadView('angsuran/pdf', compact('angsurans'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream();

        // return view('angsuran/pdf', compact('angsurans'));
    }

}
