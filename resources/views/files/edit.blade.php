@extends('layouts.app')

@section('content')
    <h1>Bestand Aanpassen</h1>
    
{!! Form::open(['action' => ['FilesController@update', $file->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class='form-group'>
        {{Form::label('filename' , 'Bestandsnaam')}}
        {{Form::text('filename', $file->filename, ['class' => 'form-control', 'placeholder' => 'Bestandsnaam'])}}
    </div>

    <div class='form-group'>
        {{Form::file('image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Opslaan', ['class' => 'btn btn-primary'])}}
    
{!! Form::close() !!}

@endsection