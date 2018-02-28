
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
kategoria INTEGER REFERENCES Kategoria (tunnus),
kayttaja INTEGER REFERENCES Kayttaja (tunnus),
valmistusohje varchar(2000)
);

