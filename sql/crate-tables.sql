CREATE TABLE drinkki
(
drinkkiID int not null,
nimi varchar(50) not null,
lempinimet varchar(300),
valmistusohje varchar(1000)
);

CREATE TABLE ainesosa
(
ainesosaID int not null,
nimi varchar(50) not null,
kuvaus varchar(1000)
);

CREATE TABLE kayttaja
(
userID int not null,
sahkoposti varchar(50) not null,
salasana varchar(30) not null,
kayttajataso int not null,
check(kayttajataso >= 1 and kayttajataso <= 3)
);
