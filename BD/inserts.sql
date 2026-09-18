use gameshop_bd;

insert into jeux (nomJeux,prix,description,reduction
,prixRabais,categorie) VALUES
('The Witcher 3', 59.99, 'Un jeu de role en monde ouvert dans un univers fantastique.', 20, 47.99, 'RPG'),

('Minecraft', 39.99, 'Un jeu de construction et de survie dans un monde genere proceduralement.', 10, 35.99, 'Sandbox'),

('Cyberpunk 2077', 69.99, 'Un jeu de role futuriste se deroulant dans la ville de Night City.', 25, 52.49, 'RPG'),

('Grand Theft Auto V', 39.99, 'Un jeu daction en monde ouvert avec une grande liberte dexploration.', 30, 27.99, 'Action'),

('FIFA 25', 79.99, 'Un jeu de simulation de football avec de nombreuses equipes et competitions.', 15, 67.99, 'Sport'),

('Hades', 29.99, 'Un jeu daction de type roguelike base sur la mythologie grecque.', 20, 23.99, 'Action'),

('Stardew Valley', 19.99, 'Un jeu de simulation agricole permettant de cultiver, pecher et explorer.', 10, 17.99, 'Simulation'),

('Elden Ring', 69.99, 'Un jeu de role et daction exigeant dans un vaste monde fantastique.', 35, 45.49, 'RPG'),

('Rocket League', 24.99, 'Un jeu de sport melant football et voitures dans des matchs rapides.', 20, 19.99, 'Sport'),

('Resident Evil Requiem', 69.99, 'Un jeu dhorreur et de survie proposant une aventure intense et angoissante.', 15, 59.49, 'Horreur');

INSERT INTO Utilisateurs (`nomUtilisateur`, `email`, `mdp`)
VALUES
  ('AnisB', 'anis.bel@example.com', 'MotDePasse123!');

INSERT INTO avis (`idUtilisateur`, `commentaire`, `etoiles`, `idJeux`)
VALUES
  (1, 'Excellent jeu, scénario captivant et graphismes superbes !', 5, 1),
  (2, 'Bon jeu mais quelques bugs à corriger.', 3, 2),
  (3, 'Un peu déçu par la durée de vie, sinon correct.', 2, 3);