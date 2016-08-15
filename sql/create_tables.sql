-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	kayttajatunnus varchar(50) NOT NULL,
	salasana varchar(50) NOT NULL,
	email varchar(50) NOT NULL
);

CREATE TABLE Paikka(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	osoite varchar(50) NOT NULL
	
);

CREATE TABLE Askare(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	tarkeys INTEGER,
        luokka varchar(50),
        paikka_id INTEGER REFERENCES Paikka(id),
        kayttaja_id INTEGER REFERENCES Kayttaja(id)
);

