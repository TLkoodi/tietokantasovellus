CREATE TABLE drinkki
(
drinkkiID SERIAL not null PRIMARY KEY,
nimi varchar(50) not null,
lempinimet varchar(300),
valmistusohje varchar(1000),
muokattu TIMESTAMP,
kayttajanimi varchar(30) not null REFERENCES kayttaja(kayttajanimi) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ainesosa
(
ainesosaID SERIAL not null PRIMARY KEY,
nimi varchar(50) not null,
kuvaus varchar(1000)
);

CREATE TABLE drinkki_ainesosa
(
drinkkiID SERIAL REFERENCES drinkki(drinkkiID) ON DELETE CASCADE ON UPDATE CASCADE, 
ainesosaID SERIAL REFERENCES ainesosa(ainesosaID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE kayttaja
(
kayttajanimi varchar(30) UNIQUE not null PRIMARY KEY,
sahkoposti varchar(50) not null,
salasana varchar(30) not null,
kayttajataso INTEGER not null,
luotu TIMESTAMP not null,
check(kayttajataso >= 1 and kayttajataso <= 3)
);
