<?php

namespace App\Http\Controllers;

use App\pinjaman;
use App\nasabah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use PDF;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pinjaman.index');
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
            'idNasabah' => $request['idNasabah'],
            'bunga' => $request['bunga'],
            'jmlPinjam' => $request['jmlPinjam'],
            'sisaPinjam' => $request['jmlPinjam'],
            'status' => $request['status']
        ];
        
        return pinjaman::create($data);
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
        $pinjaman = pinjaman::where('idPinjaman',$id)->first();

        return $pinjaman;
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
        $pinjaman = pinjaman::where('idPinjaman',$id)->first();

        $pinjaman->idNasabah = $request['idNasabah'];
        $pinjaman->bunga = $request['bunga'];
        $pinjaman->jmlPinjam = $request['jmlPinjam'];
        $pinjaman->sisaPinjam = $request['jmlPinjam'];
        $pinjaman->status = $request['status'];
        $pinjaman->update();

        return $pinjaman;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjaman = pinjaman::findOrFail($id);

        pinjaman::destroy($id);

        return response()->json([
            'success' => true 
        ]);
    }
    public function apiPinjaman(){
        $pinjaman = pinjaman::all();

        return DataTables::of($pinjaman)
            ->addColumn('nama_nasabah', function($pinjaman){
                return $pinjaman->nasabahs->firstname;
            })
            ->addColumn( 'action', function($pinjaman){
                return '<a onclick="editForm('. $pinjaman->idPinjaman .')" class="btn btn-primary btn-xs"><i class="fa fa-pen" aria-hidden="true"></i> Edit</a> ' .
                '<a onclick="deleteData('. $pinjaman->idPinjaman .')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>'; 
            })->make(true);
    }

    public function getNasabah(){
        $nasabahs = nasabah::all();

        return $nasabahs;
    }

    public function exportPDF(){
        $pinjamans = pinjaman::all();
        
        $pdf = PDF::loadView('pinjaman/pdf', compact('pinjamans'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream();

        // return view('pinjaman/pdf', compact('pinjamans'));
    }
}
