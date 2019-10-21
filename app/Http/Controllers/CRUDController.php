<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-file');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = '';
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'tgl' => 'required',
            'telp' => 'required|numeric',
            'jk' => 'required'
        ]);
        
        if ($request->file('foto')) {
            $foto = $request->file('foto')->storeAs('public/files', $request->nama . '-' . time() . '.jpg');
            $foto = str_replace("public/files/", "", $foto);
        } else {
            $foto ='default.jpg';
        }

        Storage::disk('local')->put($request->nama . '-' . time() . '.txt', 
                                $request->nama . ',' .
                                $request->email . ',' .
                                $request->tgl . ',' .
                                $request->telp . ',' .
                                $request->jk . ',' .
                                $foto
                            );
        
        return view('success');
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
    public function edit($nama, $email, $tgl, $telp, $jk, $foto, $file)
    {
        $data =[$nama, $email, $tgl, $telp, $jk, $foto, $file];
        
        return view("edit-file", ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'tgl' => 'required',
            'telp' => 'required|numeric',
            'jk' => 'required'
        ]);
        
        if ($request->file('foto')) {
            $foto = $request->file('foto')->storeAs('public/files', $request->nama . '-' . time() . '.jpg');
            $foto = str_replace("public/files/", "", $foto);
        } else {
            $foto = substr_replace($request->namafile ,"jpg",-3);
        }

        Storage::disk('local')->put($request->namafile, 
                                $request->nama . ',' .
                                $request->email . ',' .
                                $request->tgl . ',' .
                                $request->telp . ',' .
                                $request->jk . ',' .
                                $foto
                            );
        
        return view('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id2)
    {
        if ($id != "default.jpg") {
            Storage::delete('/public/files/' . $id);
        }
        Storage::delete('/' . $id2);
    }
}
