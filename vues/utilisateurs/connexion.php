<h1>Connexion</h1>
<h2><a href="index.php?action=creer">Pas de compte?</a></h2>

<?php if ($erreur !== null): ?>
    <p role="alert"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form action="index.php?action=authentifier" method="post">
    <input type="hidden" name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <label for="identifiant">Identifiant</label>
    <input id="identifiant" name="identifiant"
        value="<?= htmlspecialchars($identifiant, ENT_QUOTES, 'UTF-8') ?>"
        autocomplete="username" required>

    <label for="mot_de_passe">Mot de passe</label>
    <input id="mot_de_passe" name="mot_de_passe" type="password"
        autocomplete="current-password" required>

    <button type="submit">Se connecter</button>
</form>