@extends('layouts.app')

@section('content')
    <h1>Bestanden</h1>
    @if (count($files) > 0)
        @foreach($files as $file)
            <div class="card bg-light p-3">
               <a href="/files/{{$file->id}}"><h3 class="mb-2">{{$file->filename}}</h3></a>
               <small>Aangemaakt op {{$file->created_at}} door <strong>{{$file->user->name}}</strong></small>
            </div>
        @endforeach
        {{$files->links()}}
    @else
        <p>Geen bestanden gevonden</p>
    @endif
@endsection