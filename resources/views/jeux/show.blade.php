<p><a href="{{ route('jeux.edit', $jeu) }}">Modifier</a></p>
<form method="post" action="{{ route('jeux.destroy', $jeu) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer</button>
</form>

<article>
    <h1>{{ $jeu->nomJeu }}</h1>
    <p>{{ $jeu->description }}</p>
</article>

<h2>Commentaires</h2>
@forelse ($jeu->avis as $avis)
<article>
    <h3>{{ $avis->etoiles }}</h3>
    <p>{{ $avis->commentaire }}</p>
</article>
@empty
<p>Aucun avis.</p>
@endforelse