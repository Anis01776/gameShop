<h1>Modifier un jeu</h1>
<form method="post" action="{{ route('jeux.update', $jeu) }}">
    @method('PATCH')
    @include('jeux._form')
</form>