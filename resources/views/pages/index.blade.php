@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p></p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Inloggen</a> <a class="btn btn-success btn-lg" href="/register" role="button">Registreren</a></p>
    </div>
@endsection