<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\File;
//use DB; Enkel bij gebruik SQL queries ipv Eloquent (Zie index()->DB)

class FilesController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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
            'bestand' => 'required|max:1999' // Want apache default upload size = 2MB
        ]);
        
        // Handle file upload
        
        if($request->hasFile('bestand')){
            
            // Get filename with the extension
            $filenameWithExt = $request->file('bestand')->getClientOriginalName();
            
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just extension
            $extension = $request->file('bestand')->getClientOriginalExtension();
            
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' .$extension;
            
            // Get file size
            $filesize = $request->file('bestand')->getClientSize();
            
            // Upload file
            $path = $request->file('bestand')->storeAs('public/bestanden', $fileNameToStore);
        }
       
        // Create file
        $file = new File;
        $file->filename = $request->input('filename');
        $file->user_id = auth()->user()->id;
        $file->size = $filesize;
        $file->bestand = $fileNameToStore;
        $file->save();
        
        return redirect('/dashboard')->with('success', 'Bestand toegevoegd');
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
        
        // Check for correct user
        if(auth()->user()->id !== $file->user_id){
            return redirect('/dashboard')->with('error', 'Niet toegelaten');
        }
//         if ($request->hasFile('bestand')) {
//            Storage::delete('public/bestanden/' . $file->bestand);
//            $file->bestand = $fileNameToStore;
//        }﻿
        
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
            'filename' => 'required'
        ]);
        
        
            // Handle file upload       
            if($request->hasFile('bestand')){
                
                // Get filename with the extension
                $filenameWithExt = $request->file('bestand')->getClientOriginalName();

                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('bestand')->getClientOriginalExtension();

                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' .$extension;

                // Upload file
                $path = $request->file('bestand')->storeAs('public/bestanden', $fileNameToStore);
        }
       
        // Create file
        $file = File::find($id);
        
         // Check for correct user
        if(auth()->user()->id !== $file->user_id){
            return redirect('/dashboard')->with('error', 'Niet toegelaten');
        }
        
        $file->filename = $request->input('filename');
        if($request->hasFile('bestand')){
                $file->bestand = $fileNameToStore;
        }

        $file->save();
        
        return redirect('/dashboard')->with('success', 'Bestand aangepast');
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
        
        // Check for correct user
        if(auth()->user()->id !== $file->user_id){
            return redirect('/dashboard')->with('error', 'Niet toegelaten');
        }
        
        Storage::delete('public/bestanden/' . $file->bestand);
        
        $file->delete();
        return redirect('/dashboard')->with('success', 'Bestand verwijderd');
    }
    
    public function download($id)
    {
        $file = File::find($id);
        
        // Check for correct user
        if(auth()->user()->id !== $file->user_id){
            return redirect('/dashboard')->with('error', 'Niet toegelaten');
        }
        $bestandsnaam = $file->bestand;
        
        $pathfile = public_path() . "\storage\bestanden\\".$bestandsnaam;
      
        $headers = array('Content-Type: ' . mime_content_type( $pathfile ),);

        return response()->download($pathfile, $bestandsnaam, $headers);
    }
        
        
}
