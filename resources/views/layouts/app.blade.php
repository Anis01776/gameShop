<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jeux')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('scripts')
</head>

<body>
    <form method="post" action="{{ route('locale.update') }}">
        @csrf
        <label for="locale">Langue</label>
        <select id="locale" name="locale">
            <option value="fr" @selected(app()->getLocale() === 'fr')>Français</option>
            <option value="en" @selected(app()->getLocale() === 'en')>English</option>
        </select>
        <button type="submit">Appliquer</button>
    </form>
    @auth
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
    <form method="get" action="{{ route('account.show') }}">
        @csrf
        <button type="submit">Mon compte</button>
    </form>
    @else
    <a href="{{ route('login') }}">Connexion</a>
    <a href="{{ route('register') }}">Inscription</a>
    @endauth

    <main>
        @yield('content')
    </main>
</body>


</html>