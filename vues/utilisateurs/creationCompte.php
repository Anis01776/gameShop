<h1>Créer un compte</h1> <?php if (!empty($erreur)): ?>
    <p style="color: red;">
        <?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?>
    </p>

<?php endif; ?> <form action="index.php?action=creer-compte" method="post">
    <label for="identifiant">Nom d'utilisateur :</label>
    <input
        type="text"
        id="identifiant"
        name="identifiant"
        value="<?= htmlspecialchars($identifiant ?? '', ENT_QUOTES, 'UTF-8') ?>"
        required>

    <br><br>

    <label for="email">Email :</label>
    <input
        type="email"
        id="email"
        name="email"
        required>

    <br><br>

    <label for="mot_de_passe">Mot de passe :</label>
    <input
        type="password"
        id="mot_de_passe"
        name="mot_de_passe"
        required>

    <br><br>

    <label for="mot_de_passe2">Confirmer le mot de passe :</label>
    <input
        type="password"
        id="mot_de_passe2"
        name="mot_de_passe2"
        required>

    <br><br>

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit">Créer mon compte</button>

</form>