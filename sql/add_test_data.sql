-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kategoria (nimi) VALUES ('Pääruoka');
INSERT INTO Kategoria (nimi) VALUES ('Alkuruoka');
INSERT INTO Kategoria (nimi) VALUES ('Jälkiruoka');

INSERT INTO Kayttaja (nimi, salasana) VALUES ('Noora', 'salasana');
INSERT INTO Kayttaja (nimi, salasana) VALUES ('Ville', 'kokeilu');

INSERT INTO Resepti (nimi, valmistusaika, kategoria, kayttaja, valmistusohje) VALUES ('Kanakeitto', 30, 1, 1, 'Osta kanaa');
INSERT INTO Resepti (nimi, valmistusaika, kategoria, kayttaja, valmistusohje) VALUES ('Tofusalaatti', 15, 2, 2, 'Paista tofu');
INSERT INTO Resepti (nimi, valmistusaika, kategoria, kayttaja, valmistusohje) VALUES ('Suklaakakku', 60, 3, 1, 'Syö suklaa');
