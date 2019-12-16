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
    public function destroy($id)
    {
        //
    }
    public function apiPinjaman(){
        $pinjaman = pinjaman::all();

        return DataTables::of($pinjaman)
            ->addColumn('nama_nasabah', function($pinjaman){
                $nasabah = nasabah::find($pinjaman->idNasabah);
                return $nasabah->firstname;
            })
            ->addColumn( 'action', function($pinjaman){
                return '<a href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a> ' .
                '<a onclick="editForm('. $pinjaman->idPinjaman .')" class="btn btn-primary btn-xs"><i class="fa fa-pen" aria-hidden="true"></i> Edit</a> ' .
                '<a onclick="deleteData('. $pinjaman->idPinjaman .')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>'; 
            })->make(true);
    }
}
