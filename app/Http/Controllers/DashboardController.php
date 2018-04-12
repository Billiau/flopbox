<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\File;
Use DB;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id)->files()->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard')->with('files', $user);
    }

    public function search(Request $request) {

        $user_id = auth()->user()->id;
        if ($request->ajax()) {
            $output = "<tr><th class='table-success'>Bestandsnaam</th><th colspan='2' class='table-success'>Aangemaakt op</th></tr>";
            $results = DB::table('files')->where('filename', 'LIKE', '%' . $request->search . '%')
                                                     ->where('user_id', '=', $user_id)->get();

            if ($results) {
                
//                 foreach ($results as $key => $result) { 
//                     $outputs =[
//                                        'naam' => $result->filename,
//                                        'datum' => $result->created_at
//                     ];
//
//                 }
                
                foreach ($results as $key => $result) { 
                    $output .=    
                                        '<tr>' .
                                        '<td>' . $result->filename . '</td>' .
                                        '<td>' . $result->created_at . '</td>' .
                                        '<td>
                                                 <button id ="vuilbak" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right vuilbak" onclick="sweetDelete(event, '. $result->id .');"><i class="material-icons" id="trashcan">delete</i></button>
                                    
                                                <a href="/dashboard/'.$result->id.  '/edit" id ="potlood" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right"><i class="material-icons">mode_edit</i></a>
                                    
                                                <a href="/download/'.$result->id .' id ="down" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right"><i class="material-icons downl">file_download</i></a>
                                                                                    </td>
                                        </tr>';
                }
                return Response($output);
            } else {
                return Response()->json(['no' => 'Geen zoekresultaten']);
            }
        }
    }

}
