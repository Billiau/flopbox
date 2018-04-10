@extends('layouts.app')

@section('content')
<h1>Bestand Uploaden</h1>

{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class='form-group'>
    {{Form::text('filename', '', ['class' => 'form-control', 'placeholder' => 'Bestandsnaam'])}}
</div>

<div class='form-group'>
    {{Form::file('bestand', ['class' => 'fileup', 'id' => 'fileup', 'data-multiple-caption' => '{count} files selected', 'multiple', 'style' => 'display:none'])}}
    <a href="javascript:document.getElementById('fileup').click(); " id="bladeren" class="btn btn-dark">Bladeren</a>
    <input id="uploadFile" placeholder="Kies een bestand" disabled="disabled" />

</div>

{{Form::submit('Opslaan', ['class' => 'btn btn-primary', 'id' => 'opslaan'])}}

{!! Form::close() !!}

@endsection