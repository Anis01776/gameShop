@extends('layouts.app')

@section('content')
@if (auth()->user()?->role === \App\Models\User::ROLE_MANAGER)
<a href="{{ route('admin.index') }}">Administration</a>
@endif
<h1>Mon compte : {{ $user->name }}</h1>
@forelse ($avis as $avi)
<p>{{ $avi->commentaire }}</p>
@empty
<p>Aucun avis.</p>
@endforelse
@endsection