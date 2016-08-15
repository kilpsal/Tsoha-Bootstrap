-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(kayttajatunnus, salasana, email) VALUES ('ABC1','salasana','joku@joku.com');
INSERT INTO Paikka(nimi, osoite) VALUES ('Koti','Asd-katu 123');
INSERT INTO Askare(nimi, tarkeys, luokka, paikka_id, kayttaja_id) VALUES ('Pyyhi pölyt', 3, 'Kotityöt', 1, 1);
INSERT INTO Askare(nimi, tarkeys, luokka, paikka_id, kayttaja_id) VALUES ('Imuroi', 1, 'Kotityöt', 1, 1);