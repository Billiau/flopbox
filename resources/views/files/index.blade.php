@extends('layouts.app')

@section('content')
    <h1>Files</h1>
    @if (count($files) > 0)
        @foreach($files as $file)
        <div class="well">
           <a href="/files/{{$file->id}}"><h3>{{$file->filename}}</h3></a>
            <small>Aangemaakt op {{$file->created_at}}</small>
        </div>
        @endforeach
    @else
        <p>Geen bestanden gevonden</p>
    @endif
@endsection