<?php

namespace App\Http\Controllers;

use App\nasabah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;

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

        $input = $request->all();
        $input['photo'] = null;

        if($request->hasFile('photo')){
            $input['photo'] = '/upload/photo/' . str_slug($input['firstname'], '-') . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }

        nasabah::create($input);
        
        return response()->json([
            'success' => true 
        ]);
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
    public function edit($idNasabah)
    {
        $nasabah = Nasabah::where('idNAsabah',$idNasabah)->first();

        return $nasabah;
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
        
        $input = $request->all();
        $nasabah = nasabah::findOrFail($id);

        $input['photo'] = $nasabah->photo;

        if ($request->hasFile('photo')) {
            if ($nasabah->photo != NULL) {
                unlink(public_path($nasabah->photo));
            }
            $input['photo'] = '/upload/photo/' . str_slug($input['firstname'], '-') . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }

        $nasabah->update($input);

        return response()->json([
            'success' => true 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nasabah = nasabah::findOrFail($id);
        if ($nasabah->photo != NULL) {
            unlink(public_path($nasabah->photo));
        }

        nasabah::destroy($id);

        return response()->json([
            'success' => true 
        ]);
    }

    public function apiNasabah(){
        $nasabah = nasabah::all();

        return DataTables::of($nasabah)
            ->addColumn('show_photo', function($nasabah){
                if ($nasabah->photo == NULL) {
                    return 'No Image';
                }
                return '<img class="rounded-square" height="75" src="'. url($nasabah->photo) .'" alt="">';
            })
            ->addColumn( 'action', function($nasabah){
                return '<a onclick="editForm('. $nasabah->idNasabah .')" class="btn btn-primary btn-xs"><i class="fa fa-pen" aria-hidden="true"></i> Edit</a> ' .
                '<a onclick="deleteData('. $nasabah->idNasabah .')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>'; 
            })->rawColumns(['show_photo', 'action'])->make(true);
    }

    public function exportPDF(){
        $nasabahs = nasabah::all();
        
        $pdf = PDF::loadView('pdf', compact('nasabahs'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream();

        // return view('pdf', compact('nasabahs'));
    }

}
