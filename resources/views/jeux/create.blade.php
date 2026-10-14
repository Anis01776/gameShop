<h1>Créer un jeu</h1>
<form method="post" action="{{ route('jeux.store') }}">
    @include('jeux._form', ['jeu' => null])
</form>