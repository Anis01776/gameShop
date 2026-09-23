le nom et une courte description du projet;
# GameShop : se projet est une boutique en ligne permettant de trouver des jeux a prix abordable et en reducations
le problème auquel l’application répond;
# La solution est de trouver des prix pour des jeux videos moins chers que les prix habituelles (pour les joueurs ayant peu de moyen financier)
les logiciels requis, notamment AMPPS, Apache, PHP et MySQL;
#  AMPPS(Apache + SQL) et PHP
les versions utilisées lorsqu’elles sont importantes;
# PHP 8.2.33 + AMPPS 4.4 + MYSQL 8.0
les étapes pour récupérer le projet et préparer la base de données;
# 1-git pull 2-demarrer les services AMPPS 3-ouvrir MYSQL WORKBENCH et creer la BD
la manière de démarrer Apache et MySQL;
# 1-Ouvrir AMPPS 2-lancer les services Appache et MYSQL 3-Confirmer que les services sont vertes(ouvertes)
la configuration Apache à utiliser : le nom du fichier de configuration modifié, le bloc Alias et <Directory> adapté au projet, ainsi que l’indication qu’Apache doit être redémarré après une modification;
# fichier = httpd.conf = Alias /gameShop "C:\Users\belca\gameShop"

<!-- <Directory "C:\Users\belca\gameShop">
    Options -Indexes +FollowSymLinks
    AllowOverride All
    Require all granted
</Directory> -->
l’adresse locale permettant d’ouvrir l’application, par exemple http://localhost/projet/;
# http://localhost/gameShop
les commandes nécessaires pour installer, compiler ou démarrer le projet, s’il y en a;
#  Aucune compilation nécessaire

les nouveaux prérequis
# aucun nouveau prerequis
la reconstruction de la base
# fichier /BD/base_de_donnee.sql
la configuration PDO
# fichier /config/baseDeDonnee.php
les noms des variables d’environnement sans leurs valeurs secrètes
# SetEnv DB_HOST 
# SetEnv DB_PORT 
# SetEnv DB_DATABASE 
# SetEnv DB_USERNAME 
# SetEnv DB_PASSWORD 
la procédure de démarrage.
# executer le script de la BD et son script d'insertion au besoin puis ajouter les variables env dans le fichier httpd.conf
# ensuite ouvrrir AMPPS et verifier si les services sont ouverts et ouvrir le projet dans la page WEB
Action possibles
# on peut consulter les avis d'un jeu avec l'option d'en ajouter ou d'en supprimer.

