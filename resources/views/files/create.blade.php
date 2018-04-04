@extends('layouts.app')

@section('content')
    <h1>Bestand Uploaden</h1>
    
{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST']) !!}
    <div class='form-group'>
        {{Form::label('filename' , 'Bestandsnaam')}}
        {{Form::text('filename', '', ['class' => 'form-control', 'placeholder' => 'Bestandsnaam'])}}
    </div>

    <div class='form-group'>
        {{Form::label('file' , 'Bestand')}}
        {{Form::file('image')}}
    </div>
    {{Form::submit('Opslaan', ['class' => 'btn btn-primary'])}}
    
{!! Form::close() !!}

@endsection