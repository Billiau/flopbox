<br>
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class='alert alert-danger'>
        {{$error}}
    </div>
    <br>
    @endforeach
@endif

@if(session('success'))
    <div class='alert alert-success'>
        {{session('success')}}
    </div>
<br>
@endif

@if(session('error'))
    <div class='alert alert-danger'>
        {{session('error')}}
    </div>
<br>
@endif