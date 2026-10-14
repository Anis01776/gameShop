<h1>Jeux publiés</h1>

@forelse ($jeux as $jeu)
<article>
    <h2><a href="{{ route('jeux.show', $jeu) }}">{{ $jeu->nomJeu }}</a></h2>
</article>
@empty
<p>Aucun jeu publié.</p>
@endforelse

{{ $jeux->links() }}