@extends('layouts.app')

@section('content')
    <h1>Bestand Aanpassen</h1>
    
{!! Form::open(['action' => ['FilesController@update', $file->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class='form-group'>
        {{Form::label('filename' , 'Bestandsnaam')}}
        {{Form::text('filename', $file->filename, ['class' => 'form-control', 'placeholder' => 'Bestandsnaam'])}}
    </div>

<div class='form-group'>
    {{Form::file('bestand', ['class' => 'fileup', 'id' => 'fileup', 'data-multiple-caption' => '{count} files selected', 'multiple', 'style' => 'display:none'])}}
    <a href="javascript:document.getElementById('fileup').click(); " id="bladeren" class="btn btn-dark">Bladeren</a>
    <input id="uploadFile" placeholder="{{$file->bestand}}" disabled="disabled" />

</div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Opslaan', ['class' => 'btn btn-primary', 'id' => 'opslaan'])}}
    
{!! Form::close() !!}

@endsection