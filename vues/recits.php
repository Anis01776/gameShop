<?php ob_start();
$titrePage = "Recits"; ?>

<body>
    <p>
        Comme utilisateur, je veux acheter des jeux. Critères 1 : le panier ne peut être vide.
        2 : Il me faut assez d'argent sur ma carte pour faire la transaction.
    </p>
    <p>
        Comme Admin, je veux pouvoir mettre en réduction des jeux. Critères 1 : le jeu ne doit pas
        être déjà en rabais. 2 : le prix après rabais doit être inférieur au prix d'avant. 3 :
        la date limite du rabais doit être une date future et non passée.
    </p>
    <p>
        Comme invité, je veux pouvoir regarder quels jeux sont disponibles. Critères 1 : on ne
        peut rien ajouter au panier. 2 : les avis des autres clients ne peuvent être consultés.
    </p>
    <p>
        Comme utilisateur, je veux pouvoir ajouter des avis sur les jeux. Critères 1 : le
        client doit acheter le jeu pour mettre un avis. 2 : un seul avis doit être envoyé et
        pas plus.
    </p>
    <p>
        Comme Admin, je veux pouvoir supprimer des avis. Critères 1 : l'utilisateur doit être
        avisé de la censure. 2 : une raison doit être fournie.
    </p>
    <p>
        Comme invité, je veux pouvoir créer un compte. Critères 1 : un email et un mot de passe
        doivent être fournis. 2 : l'email doit être confirmé lors de l'inscription.
    </p>
    <p>
        Comme utilisateur, je veux pouvoir modifier mes informations. Critères 1 : le nom
        d'utilisateur ne doit pas exister. 2 : il faut être connecté pour modifier ses informations.
    </p>
    <p>
        Comme utilisateur, je veux enlever des jeux de mon panier. Critères 1 : on ne peut
        enlever un panier vide. 2 : il faut confirmer la substitution du jeu dans le panier.
    </p>
</body>

<?php
$contenu = ob_get_clean();
require __DIR__ . "/gabarit.php";
