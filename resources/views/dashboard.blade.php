@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br><br>
            <div class="card">
                <div class="card-header"><a href="/files/create" class="btn btn-primary">Voeg bestand toe</a></div>

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
                        
                        @foreach($files->reverse() as $file)
                        <tr>
                            <td>{{$file->filename}}</td>
                            <td>{{$file->created_at}}</td>
                            <td>
                                <!--<a href="/files/{{$file->id}}/edit" id="vuilbak" class="btn btn-circle d-flex justify-content-center align-items-center float-right"><i class="material-icons">delete</i></a>-->
  
                                     {!! Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right']) !!}

                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('delete', ['class' => 'material-icons', 'id' => 'vuilbak'])}}

                                    {!! Form::close() !!}
                                    
                                    <a href="/files/{{$file->id}}/edit" id ="potlood" class="btn btn-circle mr-1 d-flex justify-content-center align-items-center float-right"><i class="material-icons">mode_edit</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
            @else
            <p>Geen bestanden</p>
            @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection