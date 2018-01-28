-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kategoria(
  tunnus SERIAL PRIMARY KEY,
  nimi varchar(50)
);

CREATE TABLE Kayttaja(
  tunnus SERIAL PRIMARY KEY,
  nimi varchar(50),
  salasana varchar(10)
);

CREATE TABLE Resepti(
nimi SERIAL PRIMARY KEY,
pvm date,
valmistus_aika INTEGER,
valmistusohje varchar(2000)
);