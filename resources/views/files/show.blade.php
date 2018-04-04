@extends('layouts.app')

@section('content')
    <a href="/files" class="btn btn-outline-secondary">Terug</a>
    <h1>{{$file->filename}}</h1>
    <div id ="bestand">
        Hier komt het bestand
    </div>
    <hr>
    <small>Aangemaakt op {{$file->created_at}}</small>
    <br><br>
    <a href="/files/{{$file->id}}/edit" class="btn btn-primary">Aanpassen</a>  
    
    {!! Form::open(['action' => ['FilesController@destroy', $file->id], 'method' => 'POST', 'class' => 'float-right']) !!}

        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Verwijderen', ['class' => 'btn btn-danger'])}}

    {!! Form::close() !!}
@endsection