<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
//use DB; Enkel bij gebruik SQL queries ipv Eloquent (Zie index()->DB)

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $files = File::all();
        // $files = File::orderBy('filename', 'desc')->get(); 
        // $files = File::orderBy('filename', 'desc')->take(1)->get();  // take(limit)
        // $files = File::where('filename', 'Tweede')->get(); 
        // $files = DB::select('SELECT * from files where filename = "Eerste"'); // SQL query (use DB) 
        // $files = File::orderBy('filename', 'desc')->simplePaginate(6); // Pagina's met enkel vorige/volgende knoppen
           $files = File::orderBy('created_at', 'desc')->paginate(5); // Pagina's met nummers

        return view('files.index')->with('files', $files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required',
//            'file' => 'required'
        ]);
       
        // Create file
        $file = new File;
        $file->filename = $request->input('filename');
        $file->save();
        
        return redirect('/files')->with('success', 'Bestand toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file =  File::find($id);
        return view('files.show')->with('file', $file);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file =  File::find($id);
        return view('files.edit')->with('file', $file);


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
        $this->validate($request, [
            'filename' => 'required',
//          'file' => 'required'
        ]);
       
        // Create file
        $file = File::find($id);
        $file->filename = $request->input('filename');
        $file->save();
        
        return redirect('/files')->with('success', 'Bestand aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        $file->delete();
        
        return redirect('/files')->with('success', 'Bestand verwijderd');
    }
}
