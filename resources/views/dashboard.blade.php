@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br><br>
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/dashboard/create') }}" class="btn btn-primary">Voeg bestand toe</a>
                    <span class="form-group form-inline float-right">
                        <i class="material-icons" id="loep" onclick="document.getElementById('search').focus();">search</i>
                        <input type="text" id="search" class="form-control" name="search" onkeyup="search(this.value)" placeholder="Zoeken">
                    </span>
                </div>

                <div class="card-body">                  
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif          
                    <br>
                    <h3>Mijn bestanden</h3>
                    <br>
            @if(count($files) > 0)        
                    <table class="table">
                        <tr>
                            <th class="table-success">Bestandsnaam</th>
                            <th class="table-success" colspan="2">Aangemaakt op</th>
                        </tr>
                        
                        <!-- reverse() om de nieuwste bestanden bovenaan te krijgen -->
                        
                        @foreach($files as $file)
                        <tr>
                            <td>{{$file->filename}}</td>
                            <td><small>{{$file->created_at->format('d-m-Y || H:i:s')}}</small></td>
                            <td>
<!--
                                     Delete ook mogelijk met form
                                     
                                     {!! Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right']) !!}

                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('delete', ['class' => 'material-icons btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right', 'id' => 'vuilbak'])}}                       if (!confirm('Are you sure?')) { return false; }

                                    {!! Form::close() !!}-->
                                    
                                    <button id ="vuilbak" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right vuilbak" onclick="sweetDelete(event, {{$file->id}});"><i class="material-icons" id="trashcan">delete</i></button>
                                    
                                    <a href="{{ URL('dashboard/'.$file->id)}}/edit" id ="potlood" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right"><i class="material-icons">mode_edit</i></a>
                                    
                                    <a href="{{ URL('download/'.$file->id )}}" id ="down" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right"><i class="material-icons downl">file_download</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
             {{$files->links()}}
            @else
            <p>Geen bestanden</p>
            @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
