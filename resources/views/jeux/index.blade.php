@extends('layouts.app')
@section('title','Jeux publiés')

@section('content')
<h1>Jeux publiés</h1>

@can('create',App\Models\Jeu::class)
<a href="{{route('jeux.create')}}">creer un jeu</a>
@endcan


<label for="search">{{ __('interface.search') }}</label>
<input id="search" type="search" autocomplete="off"
    data-search-url="{{ route('recherche.jeux') }}"
    data-searching="{{ __('interface.searching') }}"
    data-empty="{{ __('interface.no_results') }}"
    data-count="{{ __('interface.results') }}"
    data-error="{{ __('interface.search_error') }}">

<p id="search-status" role="status" aria-live="polite"></p>
<ul id="search-results"></ul>

<div class="jeux-grille">
    @forelse ($jeux as $jeu)
    <article>
        <h2><a href="{{ route('jeux.show', $jeu) }}">{{ $jeu->nomJeu }}</a></h2>
    </article>
    @empty
    <p>Aucun jeu publié.</p>
    @endforelse
</div>

{{ $jeux->links() }}
@endsection


@push('scripts')
<script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush