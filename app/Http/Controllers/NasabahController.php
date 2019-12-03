<?php

namespace App\Http\Controllers;

use App\nasabah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nasabah.index');
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
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'alamat' => $request['alamat']
        ];
        
        return Nasabah::create($data);
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

    public function apiNasabah(){
        $nasabah = Nasabah::all();

        return DataTables::of($nasabah)
            ->addColumn( 'action', function($nasabah){
                return '<a href="#" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Show</a> ' .
                '<a onclick="editForm('. $nasabah->idNasabah .')" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> ' .
                '<a onclick="deleteData('. $nasabah->idNasabah .')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>'; 
            })->make(true);
    }
}
