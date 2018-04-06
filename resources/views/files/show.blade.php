@extends('layouts.app')

@section('content')
    <a href="/files" class="btn btn-outline-secondary">Terug</a>
    <h1>{{$file->filename}}</h1>
    <div id ="bestand">
        Hier komt het bestand
    </div>
    <hr>
    <small>Aangemaakt op {{$file->created_at}} door <strong>{{$file->user->name}}</strong></small>
    <br><br>
    <a href="/dashboard/{{$file->id}}/edit" class="btn btn-primary">Aanpassen</a>  
    
        @if(!Auth::guest())        
            @if(Auth::user()->id == $file->user_id)
            
                {!! Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
                
            @endif
        @endif
        
@endsection