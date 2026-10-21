@extends('layouts.app')
@section('title','Modifier un jeu')

@section('content')
<h1>Modifier un jeu</h1>

<form method="post" action="{{ route('jeux.update', $jeu) }}" enctype="multipart/form-data">
    @method('PATCH')
    @include('jeux._form')
</form>
@endsection