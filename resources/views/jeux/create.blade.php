@extends('layouts.app')
@section('title','Ajouter un jeu')

@section('content')
<h1>Créer un jeu</h1>
<form method="post" action="{{ route('jeux.store') }}" enctype="multipart/form-data">
    @include('jeux._form', ['jeu' => null])
</form>

@endsection