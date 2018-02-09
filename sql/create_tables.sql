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
tunnus SERIAL PRIMARY KEY,
nimi varchar(50),
valmistusaika INTEGER,
valmistusohje varchar(2000)
);

CREATE TABLE RuokaAine(
  tunnus SERIAL PRIMARY KEY,
  nimi varchar(50)
);

CREATE TABLE RuokaLista(
  tunnus SERIAL PRIMARY KEY,
  nimi varchar(50)
);
