@extends('layouts.app')

@section('content')
    <h1>Bestand Uploaden</h1>
    
{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class='form-group'>
        {{Form::text('filename', '', ['class' => 'form-control', 'placeholder' => 'Bestandsnaam'])}}
    </div>

    <div class='form-group'>
        {{Form::label('file' , 'Bestand')}}
        {{Form::file('bestand')}}
    </div>
    {{Form::submit('Opslaan', ['class' => 'btn btn-primary'])}}
    
{!! Form::close() !!}

@endsection